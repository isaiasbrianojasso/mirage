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
        return Category::with('children.children')
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->get();
    }

    private function getBusinessSetting()
    {
        return (object) [
            'name' => \App\Models\CompanySetting::get('store_name', 'Mirage'),
            'logo_path' => \App\Models\CompanySetting::get('store_logo', '/tienda_assets/img/mirage-logo-1534899548.jpg')
        ];
    }

    public function index()
    {
        $categories   = $this->getMenuCategories();
        $businessSetting = $this->getBusinessSetting();
        $featuredProducts = Product::with('images', 'category', 'variants')->where('is_active', true)->take(8)->get();
        $banners = \App\Models\Banner::where('is_active', true)->orderBy('order')->get();

        $lineaBlancaCat = Category::where('slug', 'linea-blanca')->first();
        $lbIds = $lineaBlancaCat ? $lineaBlancaCat->children()->pluck('id')->push($lineaBlancaCat->id)->toArray() : [];
        $lineaBlancaProducts = Product::with('images', 'category', 'variants')->whereIn('category_id', $lbIds)->where('is_active', true)->take(8)->get();

        $refaccionesCat = Category::where('slug', 'refacciones')->first();
        $refIds = $refaccionesCat ? $refaccionesCat->children()->pluck('id')->push($refaccionesCat->id)->toArray() : [];
        $refaccionesProducts = Product::with('images', 'category', 'variants')->whereIn('category_id', $refIds)->where('is_active', true)->take(8)->get();

        return view('tienda.index', compact('categories', 'featuredProducts', 'banners', 'businessSetting', 'lineaBlancaProducts', 'refaccionesProducts'));
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

    public function category($uuid)
    {
        // Buscar categoría en la base de datos por UUID o slug
        $category = Category::where('uuid', $uuid)->orWhere('slug', $uuid)->first();

        // Si no existe, redirigir al index de la tienda
        if (!$category) {
            return redirect()->route('tienda.index');
        }

        // Obtener subcategorías (hijos directos) con su conteo de productos
        $subcategories = $category->children()->withCount('products')->get();

        // Si la categoría no tiene subcategorías, mostramos los productos directamente
        $products = collect();
        if ($subcategories->isEmpty()) {
            $products = Product::with(['images', 'variants'])->where('category_id', $category->id)->where('is_active', true)->get();
        }

        $categories = $this->getMenuCategories();
        $businessSetting = $this->getBusinessSetting();

        return view('tienda.category', compact('category', 'subcategories', 'products', 'categories', 'businessSetting'));
    }

    public function product($uuid)
    {
        // Buscar producto en la base de datos por ID (que es UUID)
        $product = Product::with(['images', 'category', 'variants' => function($query) {
            $query->where('is_active', true);
        }, 'documents'])
        ->where('id', $uuid)
        ->first();

        // Si no existe, redirigir al index de la tienda
        if (!$product) {
            return redirect()->route('tienda.index');
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
            'is_approved' => false, // Requiere moderación
        ]);

        session()->flash('success', '¡Gracias! Tu opinión ha sido publicada con éxito.');

        return redirect()->back();
    }
}
