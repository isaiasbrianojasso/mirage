<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrier;
use App\Models\Zone;
use App\Models\CustomerGroup;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CarrierController extends Controller
{
    public function index(Request $request)
    {
        $query = Carrier::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $sortField = $request->get('sort_field', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        $allowedSortFields = ['id', 'name', 'transit_time', 'speed_grade', 'is_free', 'active', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $carriers = $query->orderBy($sortField, $sortDirection)->paginate(15)->withQueryString();

        return Inertia::render('Admin/Carriers/Index', [
            'carriers' => $carriers,
            'filters' => $request->only(['search', 'sort_field', 'sort_direction'])
        ]);
    }

    public function create()
    {
        $zones = Zone::where('active', true)->get();
        $customerGroups = CustomerGroup::all();
        
        return Inertia::render('Admin/Carriers/Form', [
            'carrier' => null,
            'zones' => $zones,
            'customerGroups' => $customerGroups,
            'carrierRanges' => [],
            'carrierZonePrices' => [],
            'carrierCustomerGroups' => []
        ]);
    }

    public function store(\App\Http\Requests\StoreCarrierRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            
            $data['is_free'] = filter_var($request->is_free, FILTER_VALIDATE_BOOLEAN);
            $data['active'] = filter_var($request->active, FILTER_VALIDATE_BOOLEAN);
            
            if ($request->hasFile('logo')) {
                $data['logo_path'] = $request->file('logo')->store('carriers', 'public');
            }

            unset($data['customer_groups'], $data['ranges'], $data['logo']);

            $carrier = Carrier::create($data);

            // Guardar grupos de clientes
            if ($request->has('customer_groups')) {
                $carrier->customerGroups()->sync($request->customer_groups);
            }

            // Guardar rangos y precios si no es gratis
            if (!$data['is_free'] && $request->has('ranges')) {
                foreach ($request->ranges as $rangeData) {
                    $range = $carrier->ranges()->create([
                        'delimiter1' => $rangeData['delimiter1'],
                        'delimiter2' => $rangeData['delimiter2'],
                    ]);

                    if (isset($rangeData['prices'])) {
                        foreach ($rangeData['prices'] as $zoneId => $price) {
                            $range->zonePrices()->create([
                                'carrier_id' => $carrier->id,
                                'zone_id' => $zoneId,
                                'price' => $price ?: 0,
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('carriers.index')->with('success', 'Transportista creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear transportista: ' . $e->getMessage());
        }
    }

    public function edit(Carrier $carrier)
    {
        $zones = Zone::where('active', true)->get();
        $customerGroups = CustomerGroup::all();
        
        $carrierRanges = \App\Models\CarrierRange::where('carrier_id', $carrier->id)->get();
        $carrierZonePrices = DB::table('carrier_zone_price')->where('carrier_id', $carrier->id)->get();
        $carrierCustomerGroups = DB::table('carrier_customer_group')->where('carrier_id', $carrier->id)->pluck('customer_group_id')->toArray();
        
        return Inertia::render('Admin/Carriers/Form', [
            'carrier' => $carrier,
            'zones' => $zones,
            'customerGroups' => $customerGroups,
            'carrierRanges' => $carrierRanges,
            'carrierZonePrices' => $carrierZonePrices,
            'carrierCustomerGroups' => $carrierCustomerGroups
        ]);
    }

    public function update(\App\Http\Requests\UpdateCarrierRequest $request, Carrier $carrier)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            
            $data['is_free'] = filter_var($request->is_free, FILTER_VALIDATE_BOOLEAN);
            $data['active'] = filter_var($request->active, FILTER_VALIDATE_BOOLEAN);

            if ($request->hasFile('logo')) {
                if ($carrier->logo_path) {
                    Storage::disk('public')->delete($carrier->logo_path);
                }
                $data['logo_path'] = $request->file('logo')->store('carriers', 'public');
            }

            unset($data['customer_groups'], $data['ranges'], $data['logo']);

            $carrier->update($data);

            // Actualizar grupos de clientes
            if ($request->has('customer_groups')) {
                $carrier->customerGroups()->sync($request->customer_groups);
            } else {
                $carrier->customerGroups()->sync([]);
            }

            // Actualizar rangos y precios
            if (!$data['is_free'] && $request->has('ranges')) {
                // Borrar rangos y precios anteriores (gracias a ON DELETE CASCADE esto es limpio)
                $carrier->ranges()->delete();

                foreach ($request->ranges as $rangeData) {
                    $range = $carrier->ranges()->create([
                        'delimiter1' => $rangeData['delimiter1'],
                        'delimiter2' => $rangeData['delimiter2'],
                    ]);

                    if (isset($rangeData['prices'])) {
                        foreach ($rangeData['prices'] as $zoneId => $price) {
                            $range->zonePrices()->create([
                                'carrier_id' => $carrier->id,
                                'zone_id' => $zoneId,
                                'price' => $price ?: 0,
                            ]);
                        }
                    }
                }
            } elseif ($data['is_free']) {
                $carrier->ranges()->delete();
            }

            DB::commit();
            return redirect()->route('carriers.index')->with('success', 'Transportista actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar transportista: ' . $e->getMessage());
        }
    }

    public function destroy(Carrier $carrier)
    {
        if ($carrier->logo_path) {
            Storage::disk('public')->delete($carrier->logo_path);
        }
        $carrier->delete();
        
        return redirect()->route('carriers.index')->with('success', 'Transportista eliminado.');
    }

    public function toggleActive(Carrier $carrier)
    {
        $carrier->active = !$carrier->active;
        $carrier->save();
        
        return redirect()->back()->with('success', 'Estado del transportista actualizado.');
    }
}
