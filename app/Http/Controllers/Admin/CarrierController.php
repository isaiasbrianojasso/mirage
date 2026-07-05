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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'transit_time' => 'nullable|string|max:255',
            'speed_grade' => 'nullable|integer|min:0|max:9',
            'tracking_url' => 'nullable|url|max:255',
            'is_free' => 'boolean',
            'active' => 'boolean',
            'logo' => 'nullable|image|max:2048',
            'billing_behavior' => 'required|in:price,weight',
            'out_of_range_behavior' => 'required|in:highest_range,disable',
            'max_width' => 'nullable|numeric|min:0',
            'max_height' => 'nullable|numeric|min:0',
            'max_depth' => 'nullable|numeric|min:0',
            'max_weight' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->only([
                'name', 'transit_time', 'speed_grade', 'tracking_url', 
                'is_free', 'active', 'billing_behavior', 'out_of_range_behavior',
                'max_width', 'max_height', 'max_depth', 'max_weight'
            ]);
            
            $data['is_free'] = $request->is_free === 'true' || $request->is_free === true;
            $data['active'] = $request->active === 'true' || $request->active === true;
            
            if ($request->hasFile('logo')) {
                $data['logo_path'] = $request->file('logo')->store('carriers', 'public');
            }

            $carrier = Carrier::create($data);

            // Guardar grupos de clientes
            if ($request->has('customer_groups')) {
                $groupIds = json_decode($request->customer_groups, true) ?? [];
                foreach ($groupIds as $gId) {
                    DB::table('carrier_customer_group')->insert([
                        'carrier_id' => $carrier->id,
                        'customer_group_id' => $gId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Guardar rangos y precios si no es gratis
            if (!$data['is_free'] && $request->has('ranges')) {
                $ranges = json_decode($request->ranges, true) ?? [];
                
                foreach ($ranges as $rangeData) {
                    $range = \App\Models\CarrierRange::create([
                        'carrier_id' => $carrier->id,
                        'delimiter1' => $rangeData['delimiter1'],
                        'delimiter2' => $rangeData['delimiter2'],
                    ]);

                    // Precios por zona para este rango
                    if (isset($rangeData['prices'])) {
                        foreach ($rangeData['prices'] as $zoneId => $price) {
                            DB::table('carrier_zone_price')->insert([
                                'carrier_id' => $carrier->id,
                                'zone_id' => $zoneId,
                                'carrier_range_id' => $range->id,
                                'price' => $price ?: 0,
                                'created_at' => now(),
                                'updated_at' => now(),
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

    public function update(Request $request, Carrier $carrier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'transit_time' => 'nullable|string|max:255',
            'speed_grade' => 'nullable|integer|min:0|max:9',
            'tracking_url' => 'nullable|url|max:255',
            'is_free' => 'boolean',
            'active' => 'boolean',
            'logo' => 'nullable|image|max:2048',
            'billing_behavior' => 'required|in:price,weight',
            'out_of_range_behavior' => 'required|in:highest_range,disable',
            'max_width' => 'nullable|numeric|min:0',
            'max_height' => 'nullable|numeric|min:0',
            'max_depth' => 'nullable|numeric|min:0',
            'max_weight' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->only([
                'name', 'transit_time', 'speed_grade', 'tracking_url', 
                'billing_behavior', 'out_of_range_behavior',
                'max_width', 'max_height', 'max_depth', 'max_weight'
            ]);
            
            $data['is_free'] = $request->is_free === 'true' || $request->is_free === true;
            $data['active'] = $request->active === 'true' || $request->active === true;

            if ($request->hasFile('logo')) {
                if ($carrier->logo_path) {
                    Storage::disk('public')->delete($carrier->logo_path);
                }
                $data['logo_path'] = $request->file('logo')->store('carriers', 'public');
            }

            $carrier->update($data);

            // Actualizar grupos de clientes
            DB::table('carrier_customer_group')->where('carrier_id', $carrier->id)->delete();
            if ($request->has('customer_groups')) {
                $groupIds = json_decode($request->customer_groups, true) ?? [];
                foreach ($groupIds as $gId) {
                    DB::table('carrier_customer_group')->insert([
                        'carrier_id' => $carrier->id,
                        'customer_group_id' => $gId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Actualizar rangos y precios
            if (!$data['is_free'] && $request->has('ranges')) {
                $ranges = json_decode($request->ranges, true) ?? [];
                
                \App\Models\CarrierRange::where('carrier_id', $carrier->id)->delete();
                DB::table('carrier_zone_price')->where('carrier_id', $carrier->id)->delete();

                foreach ($ranges as $rangeData) {
                    $range = \App\Models\CarrierRange::create([
                        'carrier_id' => $carrier->id,
                        'delimiter1' => $rangeData['delimiter1'],
                        'delimiter2' => $rangeData['delimiter2'],
                    ]);

                    if (isset($rangeData['prices'])) {
                        foreach ($rangeData['prices'] as $zoneId => $price) {
                            DB::table('carrier_zone_price')->insert([
                                'carrier_id' => $carrier->id,
                                'zone_id' => $zoneId,
                                'carrier_range_id' => $range->id,
                                'price' => $price ?: 0,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
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
