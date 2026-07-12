<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Mail\OrderReceipt;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $zones = \App\Models\Zone::where('active', true)->orderBy('name')->get();
        $paypalCommission = (float) \App\Models\CompanySetting::get('payment_paypal_commission', 0);
        $mercadopagoCommission = (float) \App\Models\CompanySetting::get('payment_mercadopago_commission', 0);

        return view('tienda.checkout', compact('cart', 'zones', 'paypalCommission', 'mercadopagoCommission'));
    }

    public function calculateShipping(Request $request)
    {
        $request->validate([
            'zone_id' => 'required|exists:zones,id'
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['carriers' => []]);
        }

        $totalPrice = 0;
        $totalWeight = 0;
        
        foreach ($cart as $item) {
            $quantity = $item['quantity'];
            if (!empty($item['variant_id'])) {
                $variant = \App\Models\ProductVariant::find($item['variant_id']);
                if ($variant) {
                    $totalPrice += ($variant->discount_price > 0 ? $variant->discount_price : $variant->price) * $quantity;
                    $totalWeight += ($variant->weight ?? 0) * $quantity;
                }
            } else {
                $product = \App\Models\Product::find($item['product_id']);
                if ($product) {
                    $totalPrice += ($product->discount_price > 0 ? $product->discount_price : $product->price) * $quantity;
                    $totalWeight += ($product->weight ?? 0) * $quantity;
                }
            }
        }

        $user = auth()->user();
        $customerGroupId = ($user && $user->customer_group_id) ? $user->customer_group_id : 1; 

        $carriers = \App\Models\Carrier::where('active', true)
            ->whereHas('customerGroups', function($q) use ($customerGroupId) {
                $q->where('customer_groups.id', $customerGroupId);
            })->get();

        $availableCarriers = [];

        foreach ($carriers as $carrier) {
            if ($carrier->max_weight > 0 && $totalWeight > $carrier->max_weight) {
                continue;
            }

            if ($carrier->is_free) {
                $availableCarriers[] = [
                    'id' => $carrier->id,
                    'name' => $carrier->name,
                    'transit_time' => $carrier->transit_time,
                    'cost' => 0,
                ];
                continue;
            }

            $compareValue = $carrier->billing_behavior === 'weight' ? $totalWeight : $totalPrice;

            $range = \App\Models\CarrierRange::where('carrier_id', $carrier->id)
                ->where('delimiter1', '<=', $compareValue)
                ->where('delimiter2', '>', $compareValue)
                ->first();

            $cost = null;

            if ($range) {
                $zonePrice = DB::table('carrier_zone_price')
                    ->where('carrier_range_id', $range->id)
                    ->where('zone_id', $request->zone_id)
                    ->first();
                if ($zonePrice) {
                    $cost = $zonePrice->price;
                }
            } else {
                if ($carrier->out_of_range_behavior === 'highest_range') {
                    $highestRange = \App\Models\CarrierRange::where('carrier_id', $carrier->id)
                        ->orderBy('delimiter2', 'desc')
                        ->first();
                    if ($highestRange) {
                        $zonePrice = DB::table('carrier_zone_price')
                            ->where('carrier_range_id', $highestRange->id)
                            ->where('zone_id', $request->zone_id)
                            ->first();
                        if ($zonePrice) {
                            $cost = $zonePrice->price;
                        }
                    }
                }
            }

            if ($cost !== null) {
                $availableCarriers[] = [
                    'id' => $carrier->id,
                    'name' => $carrier->name,
                    'transit_time' => $carrier->transit_time,
                    'cost' => (float) $cost,
                ];
            }
        }

        return response()->json(['carriers' => $availableCarriers]);
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('tienda.index');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_zip' => 'required|string|max:20',
            'zone_id' => 'required|exists:zones,id',
            'payment_method' => 'required|string|in:paypal,cash,mercadopago',
            'carrier_id' => 'required|exists:carriers,id',
            'transaction_id' => 'nullable|string',
        ]);

        $totalAmount = 0;
        $orderItemsData = [];
        $shippingCost = 0; 
        $totalWeight = 0;

        // Validar stock en tiempo real y RECALCULAR precios
        foreach ($cart as $key => $item) {
            $productId = $item['product_id'];
            $variantId = $item['variant_id'] ?? null;
            $quantity = $item['quantity'];

            if ($variantId) {
                $variant = ProductVariant::find($variantId);
                $stock = $variant ? $variant->stock : 0;
                $active = $variant ? $variant->is_active : false;
                $realPrice = $variant ? ($variant->discount_price > 0 ? $variant->discount_price : $variant->price) : 0;
            } else {
                $product = Product::find($productId);
                $stock = $product ? $product->stock : 0;
                $active = $product ? $product->is_active : false;
                $realPrice = $product ? ($product->discount_price > 0 ? $product->discount_price : $product->price) : 0;
            }

            if (!$active) {
                return redirect()->route('cart.index')->with('error', 'El producto "' . $item['name'] . '" ya no está disponible.');
            }

            if ($quantity > $stock) {
                return redirect()->route('cart.index')->with('error', 'El producto "' . $item['name'] . '" ya no tiene suficiente stock. (Disponible: ' . $stock . '). Por favor ajusta tu carrito.');
            }

            // Recalcular el total con el precio real de la base de datos
            $totalAmount += ($realPrice * $quantity);
            $totalWeight += ($variantId && $variant ? ($variant->weight ?? 0) : ($product ? ($product->weight ?? 0) : 0)) * $quantity;

            // Almacenar temporalmente los datos para el order_items
            $orderItemsData[] = [
                'product_id' => $productId,
                'variant_id' => $variantId,
                'name' => $item['name'],
                'price' => $realPrice,
                'quantity' => $quantity,
            ];
        }

        // Calculate Shipping Cost securely
        $carrier = \App\Models\Carrier::find($request->carrier_id);
        $zone = \App\Models\Zone::find($request->zone_id);
        $shippingCost = null;
        
        if ($carrier && $zone) {
            if ($carrier->is_free) {
                $shippingCost = 0;
            } else {
                $compareValue = $carrier->billing_behavior === 'weight' ? $totalWeight : $totalAmount;
                $range = \App\Models\CarrierRange::where('carrier_id', $carrier->id)
                    ->where('delimiter1', '<=', $compareValue)
                    ->where('delimiter2', '>', $compareValue)
                    ->first();
                
                if ($range) {
                    $zonePrice = DB::table('carrier_zone_price')
                        ->where('carrier_range_id', $range->id)
                        ->where('zone_id', $zone->id)
                        ->first();
                    if ($zonePrice) {
                        $shippingCost = $zonePrice->price;
                    }
                } else if ($carrier->out_of_range_behavior === 'highest_range') {
                    $highestRange = \App\Models\CarrierRange::where('carrier_id', $carrier->id)
                        ->orderBy('delimiter2', 'desc')
                        ->first();
                    if ($highestRange) {
                        $zonePrice = DB::table('carrier_zone_price')
                            ->where('carrier_range_id', $highestRange->id)
                            ->where('zone_id', $zone->id)
                            ->first();
                        if ($zonePrice) {
                            $shippingCost = $zonePrice->price;
                        }
                    }
                }
            }
        }

        if ($shippingCost === null) {
            return redirect()->route('checkout.index')->with('error', 'El método de envío seleccionado no es válido para tu zona o para el contenido actual de tu carrito. Por favor, selecciona otro.');
        }

        $totalAmount += $shippingCost;

        // Calculate Payment Fee
        $paymentFee = 0;
        if ($request->payment_method === 'paypal') {
            $paypalCommission = (float) \App\Models\CompanySetting::get('payment_paypal_commission', 0);
            if ($paypalCommission > 0) {
                $paymentFee = $totalAmount * ($paypalCommission / 100);
            }
        } else if ($request->payment_method === 'mercadopago') {
            $mercadopagoCommission = (float) \App\Models\CompanySetting::get('payment_mercadopago_commission', 0);
            if ($mercadopagoCommission > 0) {
                $paymentFee = $totalAmount * ($mercadopagoCommission / 100);
            }
        }

        $totalAmount += $paymentFee;

        // Mock Pasarela de Pagos
        $paymentStatus = 'pending';
        $transactionId = $request->transaction_id ?? null;

        switch ($request->payment_method) {
            case 'paypal':
                // Si PayPal envió el transaction_id significa que fue capturado exitosamente
                if ($transactionId) {
                    $paymentStatus = 'paid';
                }
                break;
            case 'cash':
                $paymentStatus = 'pending'; // Pago contra entrega u OXXO
                break;
        }

        // Crear la orden y descontar stock dentro de una transacción para evitar datos inconsistentes
        try {
            $reference = strtoupper(\Illuminate\Support\Str::random(9));
            $order = DB::transaction(function () use ($request, $totalAmount, $paymentStatus, $transactionId, $shippingCost, $orderItemsData, $reference, $carrier, $zone, $paymentFee) {
                
                $order = Order::create([
                    'reference' => $reference,
                    'user_id' => auth()->check() ? auth()->id() : null,
                    'customer_name' => $request->customer_name,
                    'customer_email' => $request->customer_email,
                    'customer_phone' => $request->customer_phone,
                    'shipping_address' => $request->shipping_address,
                    'shipping_city' => $request->shipping_city,
                    'shipping_state' => $zone ? $zone->name : 'N/A',
                    'shipping_zip' => $request->shipping_zip,
                    'total_amount' => $totalAmount,
                    'status' => $paymentStatus == 'paid' ? 'processing' : 'pending',
                    'notes' => $request->notes,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $paymentStatus,
                    'transaction_id' => $transactionId,
                    'shipping_method' => $carrier ? $carrier->name : 'Desconocido',
                    'shipping_cost' => $shippingCost,
                    'payment_fee' => $paymentFee,
                    'carrier_id' => $carrier ? $carrier->id : null,
                ]);

                // Crear los items de la orden y descontar stock
                foreach ($orderItemsData as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'product_variant_id' => $item['variant_id'],
                        'product_name' => $item['name'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                    ]);

                    // Descontar inventario asegurando que no baje de cero
                    if ($item['variant_id']) {
                        $affected = ProductVariant::where('id', $item['variant_id'])
                                      ->where('stock', '>=', $item['quantity'])
                                      ->decrement('stock', $item['quantity']);
                        if ($affected === 0) {
                            throw new \Exception('No hay suficiente stock para el producto: ' . $item['name']);
                        }
                    } else {
                        $affected = Product::where('id', $item['product_id'])
                               ->where('stock', '>=', $item['quantity'])
                               ->decrement('stock', $item['quantity']);
                        if ($affected === 0) {
                            throw new \Exception('No hay suficiente stock para el producto: ' . $item['name']);
                        }
                    }
                }

                return $order;
            });
        } catch (\Exception $e) {
            \Log::error('Error crítico al procesar la orden: ' . $e->getMessage());
            return redirect()->route('checkout.index')->with('error', 'Ocurrió un error al procesar tu pedido. Por favor, inténtalo de nuevo.');
        }

        if ($request->payment_method === 'mercadopago') {
            // Generar la preferencia en MP usando el Access Token de configuraciones
            $mpToken = \App\Models\CompanySetting::get('mercadopago_access_token');
            if (!$mpToken) {
                return redirect()->back()->with('error', 'Mercado Pago no está configurado correctamente en el sistema.');
            }

            $items = [];
            foreach ($orderItemsData as $itemData) {
                $items[] = [
                    'title' => $itemData['name'],
                    'quantity' => (int) $itemData['quantity'],
                    'currency_id' => 'MXN',
                    'unit_price' => (float) $itemData['price']
                ];
            }

            if ($shippingCost > 0) {
                $items[] = [
                    'title' => 'Costo de Envío',
                    'quantity' => 1,
                    'currency_id' => 'MXN',
                    'unit_price' => (float) $shippingCost
                ];
            }

            $host = request()->getHost();
            $isLocal = in_array($host, ['localhost', '127.0.0.1', '::1']);

            $preferenceData = [
                'items' => $items,
                'payer' => [
                    'name' => $request->customer_name,
                    'email' => $request->customer_email,
                ],
                'back_urls' => [
                    'success' => route('checkout.mercadopago.success'),
                    'failure' => route('checkout.mercadopago.failure'),
                    'pending' => route('checkout.mercadopago.pending')
                ],
                'external_reference' => $order->reference,
            ];

            // Mercado Pago rechaza el auto_return si los back_urls son localhost o 127.0.0.1
            if (!$isLocal) {
                $preferenceData['auto_return'] = 'approved';
            }

            $response = \Illuminate\Support\Facades\Http::withToken($mpToken)
                ->post('https://api.mercadopago.com/checkout/preferences', $preferenceData);

            if ($response->successful()) {
                $initPoint = $response->json()['init_point'];
                return redirect()->away($initPoint);
            } else {
                return redirect()->back()->with('error', 'Error al procesar con Mercado Pago: ' . $response->body());
            }
        }

        // Vaciar el carrito
        session()->forget('cart');

        // Enviar Correo de Recibo de Compra
        try {
            Mail::to($order->customer_email)->send(new OrderReceipt($order));
        } catch (\Exception $e) {
            \Log::error('No se pudo enviar el correo de orden: ' . $e->getMessage());
        }

        // Pasar la referencia en sesión para verificarla en la pantalla de éxito
        session()->put('order_success_reference', $order->reference);
        return redirect()->route('checkout.success', $order->reference);
    }

    /**
     * Muestra la pantalla dedicada de éxito tras la compra.
     */
    public function success($reference)
    {
        $sessionReference = session('order_success_reference');
        
        $order = Order::where('reference', $reference)->firstOrFail();
        return view('tienda.checkout-success', compact('order'));
    }

    public function mercadopagoSuccess(Request $request)
    {
        $reference = $request->query('external_reference');
        $paymentStatus = $request->query('collection_status'); // 'approved'

        $order = Order::where('reference', $reference)->first();

        if (!$order) {
            return redirect()->route('tienda.index')->with('error', 'Orden no encontrada.');
        }

        if ($paymentStatus === 'approved') {
            $order->payment_status = 'paid';
            $order->status = 'processing';
            $order->save();

            // Clear the cart
            session()->forget('cart');

            // Send confirmation email
            if ($order->customer_email) {
                try {
                    Mail::to($order->customer_email)->send(new OrderReceipt($order));
                } catch (\Exception $e) {
                    \Log::error('Error sending order receipt: ' . $e->getMessage());
                }
            }

            return redirect()->route('checkout.success', ['reference' => $order->reference])->with('success', '¡Pago procesado exitosamente por Mercado Pago!');
        }

        return redirect()->route('checkout.mercadopago.failure');
    }

    public function mercadopagoFailure(Request $request)
    {
        return redirect()->route('checkout.index')->with('error', 'El pago fue rechazado o cancelado. Por favor, intenta nuevamente.');
    }

    public function mercadopagoPending(Request $request)
    {
        return redirect()->route('checkout.index')->with('error', 'El pago está pendiente de aprobación. Nos pondremos en contacto cuando se confirme.');
    }
}
