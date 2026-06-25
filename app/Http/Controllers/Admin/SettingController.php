<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = BusinessSetting::first();
        if (!$setting) {
            $setting = BusinessSetting::create([
                'name' => 'Mirage',
                'logo_path' => '/tienda/img/mirage-logo-1534899548.jpg'
            ]);
        }
        
        return Inertia::render('Admin/Settings/Edit', [
            'setting' => $setting
        ]);
    }

    public function update(Request $request)
    {
        $setting = BusinessSetting::first();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        if ($request->hasFile('logo')) {
            $validated['logo_path'] = '/storage/' . $request->file('logo')->store('settings', 'public');
        }
        
        $setting->update(\Illuminate\Support\Arr::except($validated, ['logo']));
        
        return redirect()->back()->with('success', 'Configuración actualizada con éxito.');
    }
}
