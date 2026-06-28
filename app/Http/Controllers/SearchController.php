<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return response()->json([]);
        }

        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->select('id', 'name', 'price', 'image', 'slug')
            ->take(5)
            ->get();

        $formatted = $products->map(function($product) {
            return [
                'name' => $product->name,
                'price' => '$' . number_format($product->price, 2),
                'image' => $product->image ? asset('storage/' . $product->image) : null,
                'url' => route('tienda.product', $product->id)
            ];
        });

        return response()->json($formatted);
    }

    public function index(Request $request)
    {
        $query = $request->get('q');
        
        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->paginate(12);

        return view('tienda.search', compact('products', 'query'));
    }
}
