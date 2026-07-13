<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

        $sortField = $request->get('sort_field', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        $allowedSortFields = ['id', 'title', 'status', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $posts = $query->orderBy($sortField, $sortDirection)->paginate(15)->withQueryString();

        return Inertia::render('Admin/Posts/Index', [
            'posts' => $posts,
            'filters' => $request->only(['search', 'sort_field', 'sort_direction'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Posts/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        $validated['slug'] = Str::slug($validated['title']);
        
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }
        
        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('posts', 'public');
        }
        
        Post::create($validated);
        
        return redirect()->route('posts.index')->with('success', 'Novedad creada con éxito.');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Admin/Posts/Form', [
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        $validated['slug'] = Str::slug($validated['title']);
        
        if ($validated['status'] === 'published' && !$post->published_at) {
            $validated['published_at'] = now();
        } elseif ($validated['status'] === 'draft') {
            $validated['published_at'] = null;
        }
        
        if ($request->hasFile('image')) {
            if ($post->image_url) {
                Storage::disk('public')->delete($post->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('posts', 'public');
        }
        
        $post->update($validated);
        
        return redirect()->route('posts.index')->with('success', 'Novedad actualizada con éxito.');
    }

    public function destroy(Post $post)
    {
        if ($post->image_url) {
            Storage::disk('public')->delete($post->image_url);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Novedad eliminada con éxito.');
    }
}
