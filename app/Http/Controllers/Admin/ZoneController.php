<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use Inertia\Inertia;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::orderBy('name', 'asc')->get();
        return Inertia::render('Admin/Zones/Index', [
            'zones' => $zones
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Zones/Form', [
            'zone' => null
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:zones,name',
            'active' => 'boolean',
        ]);
        
        $data['active'] = $request->active ?? true;

        Zone::create($data);

        return redirect()->route('zones.index')->with('success', 'Zona creada exitosamente.');
    }

    public function edit(Zone $zone)
    {
        return Inertia::render('Admin/Zones/Form', [
            'zone' => $zone
        ]);
    }

    public function update(Request $request, Zone $zone)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:zones,name,' . $zone->id,
            'active' => 'boolean',
        ]);
        
        $data['active'] = $request->active ?? true;

        $zone->update($data);

        return redirect()->route('zones.index')->with('success', 'Zona actualizada exitosamente.');
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();
        
        return redirect()->route('zones.index')->with('success', 'Zona eliminada exitosamente.');
    }
}
