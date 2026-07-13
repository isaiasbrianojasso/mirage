<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class TemplateStoreController extends Controller
{
    /**
     * Muestra la pantalla de configuración de Textos de Tienda y Catálogo.
     */
    public function index()
    {
        $settings = [
            'content' => CompanySetting::getByGroup('content'),
            'tienda' => CompanySetting::getByGroup('tienda'),
        ];

        return \Inertia\Inertia::render('Admin/Templates/StoreTexts', [
            'settings' => $settings,
        ]);
    }
}
