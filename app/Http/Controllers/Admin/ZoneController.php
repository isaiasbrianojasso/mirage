<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use Inertia\Inertia;

class ZoneController extends Controller
{
    public function index(Request $request)
    {
        $query = Zone::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $sortField = $request->get('sort_field', 'name');
        $sortDirection = $request->get('sort_direction', 'asc');

        $allowedSortFields = ['id', 'name', 'active', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'name';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $zones = $query->orderBy($sortField, $sortDirection)->paginate(15)->withQueryString();

        return Inertia::render('Admin/Zones/Index', [
            'zones' => $zones,
            'filters' => $request->only(['search', 'sort_field', 'sort_direction'])
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
