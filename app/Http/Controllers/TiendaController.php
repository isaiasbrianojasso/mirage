<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\BusinessSetting;

class TiendaController extends Controller
{
    /**
     * Retorna las categorías de nivel superior con sus subcategorías anidadas.
     */
    private function getMenuCategories()
    {
        return Category::with('children')
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->get();
    }

    private function getBusinessSetting()
    {
        return BusinessSetting::first();
    }

    public function index()
    {
        $categories   = $this->getMenuCategories();
        $businessSetting = $this->getBusinessSetting();
        $featuredProducts = Product::with('images', 'category')->where('is_active', true)->take(8)->get();
        $banners = \App\Models\Banner::where('is_active', true)->orderBy('order')->get();
        return view('tienda.index', compact('categories', 'featuredProducts', 'banners', 'businessSetting'));
    }

    public function catalogAll()
    {
        $categories = $this->getMenuCategories();
        $businessSetting = $this->getBusinessSetting();
        
        $rootCategories = Category::withCount('products')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->get();
            
        return view('tienda.catalog_all', compact('categories', 'businessSetting', 'rootCategories'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            // Fallback to static blade if category not in database
            if (view()->exists('tienda.' . $slug)) {
                return view('tienda.' . $slug);
            }
            abort(404);
        }

        $products = Product::with('images')->where('category_id', $category->id)->where('is_active', true)->get();

        if (!view()->exists('tienda.category')) {
            return view('tienda.' . $slug);
        }

        $categories = $this->getMenuCategories();
        $businessSetting = $this->getBusinessSetting();

        return view('tienda.category', compact('category', 'products', 'categories', 'businessSetting'));
    }

    public function product($slug)
    {
        $product = Product::with(['images', 'category', 'variants' => function($query) {
            $query->where('is_active', true);
        }, 'documents'])->where('slug', $slug)->first();
        if (!$product) {
            if (view()->exists('tienda.' . $slug)) {
                return view('tienda.' . $slug);
            }
            abort(404);
        }
        $categories = $this->getMenuCategories();
        $businessSetting = $this->getBusinessSetting();

        // Obtener opiniones aprobadas
        $reviews = Review::where('product_id', $product->id)
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tienda.product', compact('product', 'categories', 'reviews', 'businessSetting'));
    }

    public function storeReview(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5',
        ]);

        Review::create([
            'product_id' => $product->id,
            'user_id' => auth()->check() ? auth()->id() : null,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true, // Aprobación automática en el ambiente local
        ]);

        session()->flash('success', '¡Gracias! Tu opinión ha sido publicada con éxito.');

        return redirect()->back();
    }
}
