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

        return view('tienda.checkout', compact('cart'));
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
            'payment_method' => 'required|string|in:paypal,cash,mercadopago',
            'shipping_method' => 'nullable|string',
            'transaction_id' => 'nullable|string',
        ]);

        $totalAmount = 0;
        $orderItemsData = [];
        $shippingCost = 0; // Default shipping cost

        // Validar stock en tiempo real y RECALCULAR precios
        foreach ($cart as $key => $item) {
            $productId = $item['product_id'];
            $variantId = $item['variant_id'] ?? null;
            $quantity = $item['quantity'];

            if ($variantId) {
                $variant = ProductVariant::find($variantId);
                $stock = $variant ? $variant->stock : 0;
                $active = $variant ? $variant->is_active : false;
                $realPrice = $variant ? ($variant->discount_price ?? $variant->price) : 0;
            } else {
                $product = Product::find($productId);
                $stock = $product ? $product->stock : 0;
                $active = $product ? $product->is_active : false;
                $realPrice = $product ? ($product->discount_price ?? $product->price) : 0;
            }

            if (!$active) {
                return redirect()->route('cart.index')->with('error', 'El producto "' . $item['name'] . '" ya no está disponible.');
            }

            if ($quantity > $stock) {
                return redirect()->route('cart.index')->with('error', 'El producto "' . $item['name'] . '" ya no tiene suficiente stock. (Disponible: ' . $stock . '). Por favor ajusta tu carrito.');
            }

            // Recalcular el total con el precio real de la base de datos
            $totalAmount += ($realPrice * $quantity);

            // Almacenar temporalmente los datos para el order_items
            $orderItemsData[] = [
                'product_id' => $productId,
                'variant_id' => $variantId,
                'name' => $item['name'],
                'price' => $realPrice,
                'quantity' => $quantity,
            ];
        }

        $totalAmount += $shippingCost;

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
            $order = DB::transaction(function () use ($request, $totalAmount, $paymentStatus, $transactionId, $shippingCost, $orderItemsData, $reference) {
                
                $order = Order::create([
                    'reference' => $reference,
                    'user_id' => auth()->check() ? auth()->id() : null,
                    'customer_name' => $request->customer_name,
                    'customer_email' => $request->customer_email,
                    'customer_phone' => $request->customer_phone,
                    'shipping_address' => $request->shipping_address,
                    'shipping_city' => $request->shipping_city,
                    'shipping_state' => $request->shipping_state,
                    'shipping_zip' => $request->shipping_zip,
                    'total_amount' => $totalAmount,
                    'status' => $paymentStatus == 'paid' ? 'processing' : 'pending',
                    'notes' => $request->notes,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $paymentStatus,
                    'transaction_id' => $transactionId,
                    'shipping_method' => $request->shipping_method,
                    'shipping_cost' => $shippingCost,
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
                        ProductVariant::where('id', $item['variant_id'])
                                      ->where('stock', '>=', $item['quantity'])
                                      ->decrement('stock', $item['quantity']);
                    } else {
                        Product::where('id', $item['product_id'])
                               ->where('stock', '>=', $item['quantity'])
                               ->decrement('stock', $item['quantity']);
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
