<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanySettingController extends Controller
{
    /**
     * Display a listing of all company settings grouped
     */
    public function index()
    {
        $settings = CompanySetting::all()->groupBy('group');

        return response()->json([
            'success' => true,
            'data' => $settings,
        ]);
    }

    /**
     * Get settings by group
     */
    public function byGroup($group)
    {
        $settings = CompanySetting::where('group', $group)->get()->keyBy('key');

        return response()->json([
            'success' => true,
            'group' => $group,
            'data' => $settings,
        ]);
    }

    /**
     * Get a specific setting
     */
    public function show($key)
    {
        $setting = CompanySetting::where('key', $key)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $setting,
        ]);
    }

    /**
     * Store or update a setting
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:company_settings,key',
            'value' => 'required',
            'type' => 'string|in:string,text,number,boolean,json,file',
            'group' => 'string|in:general,contact,social,branding',
            'description' => 'nullable|string',
        ]);

        $setting = CompanySetting::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Setting created successfully',
            'data' => $setting,
        ], Response::HTTP_CREATED);
    }

    /**
     * Update a setting
     */
    public function update(Request $request, $key)
    {
        $setting = CompanySetting::where('key', $key)->firstOrFail();

        $validated = $request->validate([
            'value' => 'required',
            'type' => 'string|in:string,text,number,boolean,json,file',
            'group' => 'string|in:general,contact,social,branding',
            'description' => 'nullable|string',
        ]);

        $setting->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Setting updated successfully',
            'data' => $setting,
        ]);
    }

    /**
     * Delete a setting
     */
    public function destroy($key)
    {
        $setting = CompanySetting::where('key', $key)->firstOrFail();
        $setting->delete();

        return response()->json([
            'success' => true,
            'message' => 'Setting deleted successfully',
        ]);
    }

    /**
     * Bulk update settings
     */
    public function bulkUpdate(Request $request)
    {
        $settings = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'required',
        ]);

        $updated = [];
        foreach ($settings['settings'] as $item) {
            $setting = CompanySetting::where('key', $item['key'])->first();
            if ($setting) {
                $setting->update(['value' => $item['value']]);
                $updated[] = $setting;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Settings updated successfully',
            'data' => $updated,
        ]);
    }
}
