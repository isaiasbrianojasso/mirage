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
            'shipping_state' => 'required|string|max:100',
            'shipping_zip' => 'required|string|max:20',
            'payment_method' => 'required|string|in:paypal,cash',
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
        
        // Verificación estricta: sólo puedes ver esta pantalla si acabas de completar la compra
        if (!$sessionReference || $sessionReference !== $reference) {
            // Intento de recargar o ver un pedido antiguo sin sesión, se limpia y redirige
            return redirect()->route('tienda.index');
        }

        // Limpiar la sesión para evitar que el usuario recargue y vea la misma pantalla infinitamente
        session()->forget('order_success_reference');

        // Obtener la orden de la base de datos (con sus items)
        $order = \App\Models\Order::with('items')->where('reference', $reference)->firstOrFail();

        return view('tienda.checkout-success', compact('order'));
    }
}
