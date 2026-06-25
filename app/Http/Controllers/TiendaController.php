<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

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

    public function index()
    {
        $categories   = $this->getMenuCategories();
        $featuredProducts = Product::with('images', 'category')->where('is_active', true)->take(8)->get();
        $banners = \App\Models\Banner::where('is_active', true)->orderBy('order')->get();
        return view('tienda.index', compact('categories', 'featuredProducts', 'banners'));
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

        return view('tienda.category', compact('category', 'products', 'categories'));
    }

    public function product($slug)
    {
        $product = Product::with('images', 'category')->where('slug', $slug)->first();
        if (!$product) {
            if (view()->exists('tienda.' . $slug)) {
                return view('tienda.' . $slug);
            }
            abort(404);
        }
        $categories = $this->getMenuCategories();
        return view('tienda.product', compact('product', 'categories'));
    }
}
