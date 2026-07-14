<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\BusinessSetting;

class CatalogoController extends Controller
{
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

    public function category($slug)
    {
        $category = Category::where('uuid', $slug)->orWhere('slug', $slug)->first();

        if (!$category) {
            return redirect()->route('tienda.catalog_all');
        }

        $subcategories = $category->children()->withCount('products')->get();

        $products = collect();
        if ($subcategories->isEmpty()) {
            $products = Product::with(['images', 'variants'])->where('category_id', $category->id)->where('is_active', true)->get();
        }

        $categories = $this->getMenuCategories();
        $businessSetting = $this->getBusinessSetting();

        return view('catalogo.category', compact('category', 'subcategories', 'products', 'categories', 'businessSetting'));
    }

    public function product($slug)
    {
        $product = Product::with(['images', 'category', 'variants' => function($query) {
            $query->where('is_active', true);
        }, 'documents'])
        ->where('id', $slug)
        ->orWhere('slug', $slug)
        ->first();

        if (!$product) {
            return redirect()->route('tienda.catalog_all');
        }

        $categories = $this->getMenuCategories();
        $businessSetting = $this->getBusinessSetting();

        $reviews = collect(); // Catalog page doesn't necessarily need the review logic from the store, but we pass it as empty to avoid undefined variable in views if they share partials.

        return view('catalogo.product', compact('product', 'categories', 'reviews', 'businessSetting'));
    }
}
