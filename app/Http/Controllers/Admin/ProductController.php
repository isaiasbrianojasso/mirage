<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Services\SearchIndexerService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $searchIndexer;

    public function __construct(SearchIndexerService $searchIndexer)
    {
        $this->searchIndexer = $searchIndexer;
    }

    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        $sortField = $request->get('sort_field', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        $allowedSortFields = ['id', 'name', 'category', 'price', 'stock', 'is_active', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        if ($sortField === 'category') {
            $query->orderBy(
                \App\Models\Category::select('name')->whereColumn('categories.id', 'products.category_id'),
                $sortDirection
            );
        } else {
            $query->orderBy($sortField, $sortDirection);
        }

        $products = $query->paginate(15)->withQueryString();

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
            'filters' => $request->only(['search', 'sort_field', 'sort_direction'])
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
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku',
            'stock' => 'required|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'depth' => 'nullable|numeric|min:0',
            'additional_shipping_cost' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'video_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'variants' => 'nullable|array',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.sku' => 'nullable|string|max:255|unique:product_variants,sku',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.wholesale_price' => 'nullable|numeric|min:0',
            'variants.*.discount_price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.attributes' => 'nullable|array',
            'variants.*.weight' => 'nullable|numeric',
            'variants.*.width' => 'nullable|numeric',
            'variants.*.height' => 'nullable|numeric',
            'variants.*.depth' => 'nullable|numeric',
            'variants.*.additional_shipping_cost' => 'nullable|numeric',
            'documents' => 'nullable|array',
            'documents.*.title' => 'required|string|max:255',
            'documents.*.type' => 'required|string|max:50',
            'documents.*.file' => 'required|file|mimes:pdf,doc,docx,zip|max:5120',
        ]);
        
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'wholesale_price' => $request->wholesale_price,
            'discount_price' => $request->discount_price,
            'sku' => $request->sku,
            'stock' => $request->stock,
            'short_description' => $request->description,
            'long_description' => $request->long_description,
            'specifications' => $request->specifications,
            'is_active' => $request->has('is_active') ? $request->is_active : true,
            'video_url' => $request->video_url,
            'weight' => $request->weight ?? 0,
            'width' => $request->width ?? 0,
            'height' => $request->height ?? 0,
            'depth' => $request->depth ?? 0,
            'additional_shipping_cost' => $request->additional_shipping_cost ?? 0,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                $product->images()->create([
                    'image_url' => $path,
                    'is_primary' => $index === 0
                ]);
            }
        }

        if (!empty($validated['variants'])) {
            foreach ($validated['variants'] as $variantData) {
                $product->variants()->create([
                    'name' => $variantData['name'],
                    'sku' => $variantData['sku'] ?? null,
                    'price' => $variantData['price'],
                    'wholesale_price' => $variantData['wholesale_price'] ?? 0,
                    'discount_price' => $variantData['discount_price'] ?? null,
                    'stock' => $variantData['stock'],
                    'attributes' => $variantData['attributes'] ?? [],
                    'weight' => $variantData['weight'] ?? 0,
                    'width' => $variantData['width'] ?? 0,
                    'height' => $variantData['height'] ?? 0,
                    'depth' => $variantData['depth'] ?? 0,
                    'additional_shipping_cost' => $variantData['additional_shipping_cost'] ?? 0,
                    'is_active' => true,
                ]);
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

        // Indexar producto para búsqueda
        $this->searchIndexer->indexProduct($product);
        
        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
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
            'wholesale_price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'video_url' => 'nullable|url|max:255',
            'stock' => 'integer|min:0',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'depth' => 'nullable|numeric|min:0',
            'additional_shipping_cost' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:product_images,id',
            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|integer',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.sku' => 'nullable|string|max:100',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.wholesale_price' => 'nullable|numeric|min:0',
            'variants.*.discount_price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.weight' => 'nullable|numeric|min:0',
            'variants.*.width' => 'nullable|numeric|min:0',
            'variants.*.height' => 'nullable|numeric|min:0',
            'variants.*.depth' => 'nullable|numeric|min:0',
            'variants.*.additional_shipping_cost' => 'nullable|numeric|min:0',
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

        // Indexar producto para búsqueda
        $this->searchIndexer->indexProduct($product->fresh(['variants']));
        
        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
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
