<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        // Clean up old cart format if present
        foreach ($cart as $key => $item) {
            if (!isset($item['product_id'])) {
                session()->forget('cart');
                $cart = [];
                break;
            }
        }
        
        return view('tienda.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id',
        ]);

        $product = Product::with('images', 'variants')->where('is_active', true)->findOrFail($request->product_id);
        
        $variant = null;
        if ($request->variant_id) {
            $variant = ProductVariant::where('product_id', $product->id)
                ->where('is_active', true)
                ->findOrFail($request->variant_id);
        } else if ($product->variants && $product->variants->where('is_active', true)->count() > 0) {
            return redirect()->back()->with('error', 'Por favor, selecciona una capacidad/modelo.');
        }

        $availableStock = $variant ? $variant->stock : $product->stock;
        
        $price = $variant 
            ? ($variant->discount_price ?? $variant->price)
            : ($product->discount_price ?? $product->price);

        $name = $variant ? $product->name . ' - ' . $variant->name : $product->name;
        
        $cartKey = $variant ? $product->id . '_' . $variant->id : (string)$product->id;

        $cart = session()->get('cart', []);
        
        // Clean up old cart format if present
        if (!empty($cart) && !isset(current($cart)['product_id'])) {
            $cart = [];
        }

        $currentQuantity = isset($cart[$cartKey]) ? $cart[$cartKey]['quantity'] : 0;
        $newQuantity = $currentQuantity + $request->quantity;

        if ($newQuantity > $availableStock) {
            return redirect()->back()->with('error', 'No hay suficiente stock disponible. (Stock: ' . $availableStock . ')');
        }

        $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
        $imageUrl = $primaryImage ? $primaryImage->image_url : null;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] = $newQuantity;
        } else {
            $cart[$cartKey] = [
                'product_id' => $product->id,
                'variant_id' => $variant ? $variant->id : null,
                'name' => $name,
                'quantity' => $request->quantity,
                'price' => $price,
                'image_url' => $imageUrl,
                'id' => $product->id,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $productId = $cart[$id]['product_id'];
            $variantId = $cart[$id]['variant_id'];

            if ($variantId) {
                $variant = ProductVariant::find($variantId);
                $availableStock = $variant ? $variant->stock : 0;
            } else {
                $product = Product::find($productId);
                $availableStock = $product ? $product->stock : 0;
            }

            if ($request->quantity > $availableStock) {
                return redirect()->back()->with('error', 'No hay suficiente stock disponible para la cantidad solicitada. (Stock: ' . $availableStock . ')');
            }

            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Carrito actualizado exitosamente.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('tienda.index')->with('success', 'Carrito vaciado exitosamente.');
    }
}
