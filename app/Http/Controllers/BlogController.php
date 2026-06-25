<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')->orderBy('published_at', 'desc')->paginate(10);
        if (!view()->exists('blog.index')) {
            return view('pages.comunicacion.blog');
        }
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            if (view()->exists('pages.comunicacion.blog')) {
                return view('pages.comunicacion.blog');
            }
            abort(404);
        }
        if (!view()->exists('blog.show')) {
            return view('pages.comunicacion.blog');
        }
        return view('blog.show', compact('post'));
    }
}
