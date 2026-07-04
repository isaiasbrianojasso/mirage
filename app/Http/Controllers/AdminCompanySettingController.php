<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;

class AdminCompanySettingController extends Controller
{
    /**
     * Muestra el panel de configuración de empresa con todos los grupos.
     */
    public function edit()
    {
        $groups = ['general', 'branding', 'contact', 'social', 'content', 'home_template', 'store_template', 'tienda'];

        $settings = [];
        foreach ($groups as $group) {
            $settings[$group] = CompanySetting::getByGroup($group);
        }

        return \Inertia\Inertia::render('Admin/CompanySettings/Edit', [
            'settings' => $settings,
        ]);
    }

    /**
     * Guarda un grupo de configuraciones enviado desde el formulario.
     * El request debe incluir un campo `group` y los pares clave-valor.
     */
    public function update(Request $request)
    {
        $request->validate([
            'group' => 'required|string|in:general,branding,contact,social,content,home_template,store_template,tienda',
            'settings' => 'required|array',
            'settings.*' => 'nullable|string|max:2000',
        ]);

        $group = $request->input('group');

        foreach ($request->input('settings', []) as $key => $value) {
            CompanySetting::set($key, $value ?? '', 'string', $group);
        }

        return redirect()->back()->with('success', 'Configuración guardada correctamente.');
    }
}
