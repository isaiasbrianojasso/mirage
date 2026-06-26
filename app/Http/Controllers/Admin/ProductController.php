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
            'long_description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'specifications.*' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'stock' => 'integer|min:0',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|integer',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.sku' => 'nullable|string|max:100',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.discount_price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.attributes' => 'nullable|array',
            'documents' => 'nullable|array',
            'documents.*.title' => 'required|string|max:255',
            'documents.*.type' => 'required|string|max:50',
            'documents.*.file' => 'required|file|mimes:pdf,zip|max:20480',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        // Map form 'description' to the DB column 'short_description'
        if (array_key_exists('description', $validated)) {
            $validated['short_description'] = $validated['description'];
            unset($validated['description']);
        }
        
        $product = Product::create(\Illuminate\Support\Arr::except($validated, ['images', 'variants', 'documents']));
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                $product->images()->create([
                    'image_url' => $path,
                    'is_primary' => $index === 0 // Make the first one primary by default
                ]);
            }
        }

        if (!empty($validated['variants'])) {
            foreach ($validated['variants'] as $variantData) {
                $product->variants()->create(\Illuminate\Support\Arr::except($variantData, ['id']));
            }
        }

        if ($request->has('documents')) {
            foreach ($request->input('documents', []) as $index => $docData) {
                if ($request->hasFile("documents.{$index}.file")) {
                    $file = $request->file("documents.{$index}.file");
                    $path = $file->store('documents', 'public');
                    $product->documents()->create([
                        'title' => $docData['title'],
                        'type' => $docData['type'],
                        'file_path' => $path,
                    ]);
                }
            }
        }
        
        return redirect()->route('products.index')->with('success', 'Producto creado con éxito.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load(['images', 'variants', 'documents']);
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
            'long_description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'specifications.*' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'stock' => 'integer|min:0',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:product_images,id',
            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|integer',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.sku' => 'nullable|string|max:100',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.discount_price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.attributes' => 'nullable|array',
            'delete_variants' => 'nullable|array',
            'delete_variants.*' => 'exists:product_variants,id',
            'documents' => 'nullable|array',
            'documents.*.title' => 'required|string|max:255',
            'documents.*.type' => 'required|string|max:50',
            'documents.*.file' => 'nullable|file|mimes:pdf,zip|max:20480',
            'delete_documents' => 'nullable|array',
            'delete_documents.*' => 'exists:product_documents,id',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        // Map form 'description' to the DB column 'short_description'
        if (array_key_exists('description', $validated)) {
            $validated['short_description'] = $validated['description'];
            unset($validated['description']);
        }
        
        $product->update(\Illuminate\Support\Arr::except($validated, ['images', 'delete_images', 'variants', 'delete_variants', 'documents', 'delete_documents']));
        
        // Handle deletions
        if (!empty($validated['delete_images'])) {
            $imagesToDelete = ProductImage::whereIn('id', $validated['delete_images'])->get();
            foreach ($imagesToDelete as $img) {
                Storage::disk('public')->delete($img->image_url);
                $img->delete();
            }
        }
        if (!empty($validated['delete_variants'])) {
            $product->variants()->whereIn('id', $validated['delete_variants'])->delete();
        }
        if (!empty($validated['delete_documents'])) {
            $docsToDelete = \App\Models\ProductDocument::whereIn('id', $validated['delete_documents'])->get();
            foreach ($docsToDelete as $doc) {
                Storage::disk('public')->delete($doc->file_path);
                $doc->delete();
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

        if (!empty($validated['variants'])) {
            foreach ($validated['variants'] as $variantData) {
                if (!empty($variantData['id'])) {
                    $product->variants()->where('id', $variantData['id'])->update(\Illuminate\Support\Arr::except($variantData, ['id']));
                } else {
                    $product->variants()->create(\Illuminate\Support\Arr::except($variantData, ['id']));
                }
            }
        }

        if ($request->has('documents')) {
            foreach ($request->input('documents', []) as $index => $docData) {
                if ($request->hasFile("documents.{$index}.file")) {
                    $file = $request->file("documents.{$index}.file");
                    $path = $file->store('documents', 'public');
                    $product->documents()->create([
                        'title' => $docData['title'],
                        'type' => $docData['type'],
                        'file_path' => $path,
                    ]);
                }
            }
        }
        
        return redirect()->route('products.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_url);
        }
        foreach ($product->documents as $doc) {
            Storage::disk('public')->delete($doc->file_path);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado con éxito.');
    }
}
