<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        // Fallback to static if dynamic not built yet
        if (!view()->exists('distribuidores.index')) {
            return view('pages.distribuidores');
        }
        return view('distribuidores.index', compact('distributors'));
    }
}
