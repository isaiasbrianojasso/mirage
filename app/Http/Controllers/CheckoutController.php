<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;

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
            'payment_method' => 'required|string|in:transfer,card,cash',
            'shipping_method' => 'nullable|string',
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
        $transactionId = null;

        switch ($request->payment_method) {
            case 'card':
                // Aquí iría la integración con Stripe o pasarela de pago.
                // try { $charge = Stripe::charge(...) ... }
                // MOCK SUCCESS:
                $paymentStatus = 'paid';
                $transactionId = 'txn_mock_' . uniqid();
                break;
            case 'transfer':
                $paymentStatus = 'pending'; // El admin lo marcará como pagado cuando reciba comprobante
                break;
            case 'cash':
                $paymentStatus = 'pending'; // Pago contra entrega u OXXO
                break;
        }

        // Crear la orden
        $order = Order::create([
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

            // Descontar inventario
            if ($item['variant_id']) {
                ProductVariant::where('id', $item['variant_id'])->decrement('stock', $item['quantity']);
            } else {
                Product::where('id', $item['product_id'])->decrement('stock', $item['quantity']);
            }
        }

        // Vaciar el carrito
        session()->forget('cart');

        return redirect()->route('tienda.index')->with('success', '¡Gracias por tu compra! Tu pedido #' . $order->id . ' ha sido registrado exitosamente.');
    }
}
