<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display the catalog index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('catalog.index');
    }

    /**
     * Display a specific category in the catalog.
     *
     * @param  string  $category
     * @return \Illuminate\View\View
     */
    public function category($category)
    {
        return view('catalog.category', ['category' => $category]);
    }

    /**
     * Display a specific subcategory in the catalog.
     *
     * @param  string  $category
     * @param  string  $subcategory
     * @return \Illuminate\View\View
     */
    public function subcategory($category, $subcategory)
    {
        return view('catalog.subcategory', [
            'category' => $category,
            'subcategory' => $subcategory
        ]);
    }
}
