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
        $groups = ['general', 'branding', 'contact', 'social', 'content', 'home_template', 'store_template', 'tienda', 'payments', 'mail', 'notifications', 'auth', 'integrations'];

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
            'group' => 'required|string|in:general,branding,contact,social,content,home_template,store_template,tienda,payments,mail,notifications,auth,integrations',
            'settings' => 'required|array',
            'settings.*' => 'nullable|string|max:4000',
        ]);

        $group = $request->input('group');
        $secretKeys = [
            'facebook_client_secret',
            'google_client_secret',
            'mail_password',
            'mercadopago_access_token',
            'paypal_secret',
            'trustlogin_client_secret',
        ];

        foreach ($request->input('settings', []) as $key => $value) {
            if (in_array($key, $secretKeys, true) && blank($value) && CompanySetting::where('key', $key)->exists()) {
                continue;
            }

            CompanySetting::set($key, $value ?? '', 'string', $group);
        }

        return redirect()->back()->with('success', 'Configuración guardada correctamente.');
    }
}
