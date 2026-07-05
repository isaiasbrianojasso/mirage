<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Address;
use App\Models\Carrier;
use App\Models\Zone;
use App\Models\OrderHistory;
use App\Models\OrderPayment;
use App\Models\OrderMessage;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CompanySetting;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $sortField = $request->get('sort_field', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        $allowedSortFields = ['id', 'customer_name', 'created_at', 'total_amount', 'status', 'payment_status'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $orders = $query->orderBy($sortField, $sortDirection)->paginate(15)->withQueryString();

        return Inertia::render('Admin/Orders/Index', [
            'orders' => $orders,
            'filters' => $request->only(['search', 'sort_field', 'sort_direction'])
        ]);
    }

    public function create()
    {
        $customers = User::all();
        $products = Product::with('images', 'category')->get();
        $zones = Zone::where('active', true)->get();
        
        return Inertia::render('Admin/Orders/Create', [
            'customers' => $customers,
            'products' => $products,
            'zones' => $zones
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'payment_method' => 'required|string',
            'status' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'shipping_cost' => 'nullable|numeric|min:0',
            'delivery_address_id' => 'nullable|exists:addresses,id',
            'invoice_address_id' => 'nullable|exists:addresses,id',
            'carrier_id' => 'nullable|exists:carriers,id',
            'total_weight' => 'nullable|numeric|min:0',
        ]);

        $customer = User::find($request->user_id);

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            $orderItems = [];

            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                
                // Aplicar descuento de grupo
                $unitPrice = $product->price;
                if ($customer->customerGroup && $customer->customerGroup->discount_percentage > 0) {
                    $unitPrice = $unitPrice * (1 - ($customer->customerGroup->discount_percentage / 100));
                }
                
                $finalPrice = isset($item['manual_price']) ? $item['manual_price'] : $unitPrice;
                
                $subtotal = $finalPrice * $item['quantity'];
                $totalAmount += $subtotal;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $finalPrice,
                    'quantity' => $item['quantity'],
                ];
                
                // Reducir stock
                $product->decrement('stock', $item['quantity']);
            }

            $shippingCost = $request->shipping_cost ?? 0;
            $totalAmount += $shippingCost;

            $order = Order::create([
                'user_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'total_amount' => $totalAmount,
                'status' => $request->status,
                'payment_method' => $request->payment_method,
                'shipping_cost' => $shippingCost,
                'delivery_address_id' => $request->delivery_address_id,
                'invoice_address_id' => $request->invoice_address_id,
                'carrier_id' => $request->carrier_id,
                'total_weight' => $request->total_weight ?? 0,
                'notes' => 'Pedido creado manualmente desde el panel de administración.',
            ]);

            foreach ($orderItems as $item) {
                $order->items()->create($item);
            }

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pedido creado exitosamente.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear el pedido: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $order = Order::with([
            'items.product', 
            'histories.user', 
            'payments', 
            'messages.user'
        ])->findOrFail($id);
        
        return Inertia::render('Admin/Orders/Show', [
            'order' => $order
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $originalStatus = $order->status;
        
        if ($originalStatus !== $request->status) {
            $order->status = $request->status;
            $order->save();

            // Guardar en el historial
            OrderHistory::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'status' => $request->status,
                'email_sent' => false, // Stub para enviar correos
            ]);

            // Rutina de Re-stock
            if ($request->status === 'cancelled') {
                foreach ($order->items as $item) {
                    if ($item->product_variant_id) {
                        \App\Models\ProductVariant::where('id', $item->product_variant_id)->increment('stock', $item->quantity);
                    } else {
                        \App\Models\Product::where('id', $item->product_id)->increment('stock', $item->quantity);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Estado del pedido actualizado.');
    }

    public function addPayment(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'transaction_id' => 'nullable|string',
        ]);

        $order = Order::findOrFail($id);

        OrderPayment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'transaction_id' => $request->transaction_id,
        ]);

        return redirect()->back()->with('success', 'Pago registrado exitosamente.');
    }

    public function addMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'is_private' => 'boolean',
        ]);

        $order = Order::findOrFail($id);

        $orderMessage = OrderMessage::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'is_private' => $request->is_private ?? false,
        ]);

        if (!$orderMessage->is_private && $order->customer_email) {
            try {
                \Illuminate\Support\Facades\Mail::to($order->customer_email)->send(new \App\Mail\OrderMessageNotification($order, $orderMessage));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Error sending order message email: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Mensaje añadido exitosamente.');
    }

    public function processRefund(Request $request, $id)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:order_items,id',
            'items.*.refund_quantity' => 'required|integer|min:0',
            'refund_shipping' => 'boolean',
            'restock' => 'boolean',
        ]);

        $order = Order::with('items')->findOrFail($id);
        $totalRefundAmount = 0;

        foreach ($request->items as $itemData) {
            if ($itemData['refund_quantity'] > 0) {
                $orderItem = $order->items->where('id', $itemData['id'])->first();
                if ($orderItem) {
                    $availableToRefund = $orderItem->quantity - $orderItem->quantity_refunded;
                    $qtyToRefund = min($itemData['refund_quantity'], $availableToRefund);
                    
                    if ($qtyToRefund > 0) {
                        $refundAmount = $qtyToRefund * $orderItem->price;
                        $totalRefundAmount += $refundAmount;

                        $orderItem->quantity_refunded += $qtyToRefund;
                        $orderItem->amount_refunded += $refundAmount;
                        $orderItem->save();

                        // Restock
                        if ($request->restock) {
                            if ($orderItem->product_variant_id) {
                                \App\Models\ProductVariant::where('id', $orderItem->product_variant_id)->increment('stock', $qtyToRefund);
                            } else {
                                \App\Models\Product::where('id', $orderItem->product_id)->increment('stock', $qtyToRefund);
                            }
                        }
                    }
                }
            }
        }

        // Refund Shipping
        if ($request->refund_shipping && $order->shipping_cost > 0) {
            // Asumimos que se reembolsa el costo de envío completo si no se ha reembolsado antes
            // Para simplificar, lo añadimos al monto de reembolso si total_refunded es 0
            if ($order->total_refunded == 0) {
                $totalRefundAmount += $order->shipping_cost;
            }
        }

        if ($totalRefundAmount > 0) {
            $order->total_refunded += $totalRefundAmount;
            $order->save();

            // Crear un pago negativo para balancear
            OrderPayment::create([
                'order_id' => $order->id,
                'payment_method' => 'Reembolso (Sistema)',
                'amount' => -$totalRefundAmount,
                'transaction_id' => 'REFUND-' . time(),
            ]);

            OrderHistory::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'status' => 'Reembolso Parcial',
                'email_sent' => false,
            ]);

            return redirect()->back()->with('success', 'Reembolso procesado correctamente por $' . number_format($totalRefundAmount, 2));
        }

        return redirect()->back()->with('error', 'No se ha procesado ningún reembolso.');
    }

    public function getCustomerAddresses(Request $request, $customerId)
    {
        $addresses = Address::where('user_id', $customerId)->get();
        return response()->json($addresses);
    }

    public function getCarriersForZone(Request $request, $zoneId)
    {
        $weight = $request->get('weight', 0);
        $price = $request->get('price', 0);

        $carriers = Carrier::where('active', true)->get();
        $availableCarriers = [];

        foreach ($carriers as $carrier) {
            if ($request->has('customer_group_id') && $request->customer_group_id) {
                $hasAccess = \Illuminate\Support\Facades\DB::table('carrier_customer_group')
                    ->where('carrier_id', $carrier->id)
                    ->where('customer_group_id', $request->customer_group_id)
                    ->exists();
                if (\Illuminate\Support\Facades\DB::table('carrier_customer_group')->where('carrier_id', $carrier->id)->count() > 0 && !$hasAccess) {
                    continue;
                }
            }

            if ($carrier->max_weight > 0 && $weight > $carrier->max_weight) continue;

            if ($carrier->is_free) {
                $carrier->calculated_price = 0;
                $availableCarriers[] = $carrier;
                continue;
            }

            $compareValue = $carrier->billing_behavior === 'weight' ? $weight : $price;

            $range = \App\Models\CarrierRange::where('carrier_id', $carrier->id)
                ->where('delimiter1', '<=', $compareValue)
                ->where('delimiter2', '>', $compareValue)
                ->first();

            if (!$range) {
                if ($carrier->out_of_range_behavior === 'disable') {
                    continue;
                }
                $range = \App\Models\CarrierRange::where('carrier_id', $carrier->id)
                    ->orderBy('delimiter2', 'desc')
                    ->first();
                if (!$range) continue;
            }

            $zonePrice = \Illuminate\Support\Facades\DB::table('carrier_zone_price')
                ->where('carrier_id', $carrier->id)
                ->where('zone_id', $zoneId)
                ->where(function ($q) use ($range) {
                    $q->where('carrier_range_id', $range->id)
                      ->orWhereNull('carrier_range_id');
                })
                ->first();

            if ($zonePrice) {
                $carrier->calculated_price = $zonePrice->price;
                $availableCarriers[] = $carrier;
            }
        }

        return response()->json($availableCarriers);
    }
}
