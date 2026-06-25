<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('categories', 'public');
        }
        
        Category::create($validated);
        
        return redirect()->route('categories.index')->with('success', 'Categoría creada con éxito.');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Form', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        if ($request->hasFile('image')) {
            if ($category->image_url) {
                Storage::disk('public')->delete($category->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('categories', 'public');
        }
        
        $category->update($validated);
        
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada con éxito.');
    }

    public function destroy(Category $category)
    {
        if ($category->image_url) {
            Storage::disk('public')->delete($category->image_url);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada con éxito.');
    }
}
