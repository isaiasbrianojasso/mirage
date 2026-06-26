<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $wishlistItems = Wishlist::with('product.images')
            ->where('user_id', Auth::id())
            ->get();

        return view('tienda.wishlist', compact('wishlistItems'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'unauthorized',
                'message' => 'Debe iniciar sesión para guardar en la lista de deseos.'
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Producto agregado a la lista de deseos con éxito.'
        ]);
    }

    public function remove(Request $request, $product_id)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'unauthorized',
                'message' => 'Acción no autorizada.'
            ], 401);
        }

        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product_id)
            ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Producto eliminado de la lista de deseos.'
        ]);
    }
}
