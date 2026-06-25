<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Inertia\Inertia;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        return Inertia::render('Admin/Banners/Index', [
            'banners' => $banners
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Banners/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            $validated['image_url'] = '/storage/' . $request->file('image')->store('banners', 'public');
        } else {
            // Default or fallback image if required, or validation should make it required
            $validated['image_url'] = 'https://via.placeholder.com/800x400';
        }
        
        Banner::create(\Illuminate\Support\Arr::except($validated, ['image']));
        
        return redirect()->route('banners.index')->with('success', 'Banner creado con éxito.');
    }

    public function edit(Banner $banner)
    {
        return Inertia::render('Admin/Banners/Form', [
            'banner' => $banner
        ]);
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link_url' => 'nullable|string|max:255',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            $validated['image_url'] = '/storage/' . $request->file('image')->store('banners', 'public');
        }
        
        $banner->update(\Illuminate\Support\Arr::except($validated, ['image']));
        
        return redirect()->route('banners.index')->with('success', 'Banner actualizado con éxito.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner eliminado con éxito.');
    }
}
