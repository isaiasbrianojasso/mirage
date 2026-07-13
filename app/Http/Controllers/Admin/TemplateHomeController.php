<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class TemplateHomeController extends Controller
{
    /**
     * Muestra la pantalla de configuración de Textos de Inicio.
     */
    public function index()
    {
        $settings = [
            'home_template' => CompanySetting::getByGroup('home_template'),
        ];

        return \Inertia\Inertia::render('Admin/Templates/HomeTexts', [
            'settings' => $settings,
        ]);
    }

}
