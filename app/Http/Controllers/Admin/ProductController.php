<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('name')->get();
        return Inertia::render('Admin/Products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Admin/Products/Form', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'stock' => 'integer|min:0',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        // Map form 'description' to the DB column 'short_description'
        if (array_key_exists('description', $validated)) {
            $validated['short_description'] = $validated['description'];
            unset($validated['description']);
        }
        
        $product = Product::create(\Illuminate\Support\Arr::except($validated, ['images']));
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                $product->images()->create([
                    'image_url' => $path,
                    'is_primary' => $index === 0 // Make the first one primary by default
                ]);
            }
        }
        
        return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images');
        return Inertia::render('Admin/Products/Form', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'stock' => 'integer|min:0',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:product_images,id',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        // Map form 'description' to the DB column 'short_description'
        if (array_key_exists('description', $validated)) {
            $validated['short_description'] = $validated['description'];
            unset($validated['description']);
        }
        
        $product->update(\Illuminate\Support\Arr::except($validated, ['images', 'delete_images']));
        
        // Handle deletions
        if (!empty($validated['delete_images'])) {
            $imagesToDelete = ProductImage::whereIn('id', $validated['delete_images'])->get();
            foreach ($imagesToDelete as $img) {
                Storage::disk('public')->delete($img->image_url);
                $img->delete();
            }
        }
        
        // Handle new uploads
        if ($request->hasFile('images')) {
            $existingCount = $product->images()->count();
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                $product->images()->create([
                    'image_url' => $path,
                    'is_primary' => ($existingCount === 0 && $index === 0)
                ]);
            }
        }
        
        return redirect()->route('products.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_url);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado con éxito.');
    }
}
