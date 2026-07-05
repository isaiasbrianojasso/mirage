<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerGroup;
use App\Models\Category;
use Inertia\Inertia;

class CustomerGroupController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomerGroup::withCount('users');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $sortField = $request->get('sort_field', 'name');
        $sortDirection = $request->get('sort_direction', 'asc');

        $allowedSortFields = ['id', 'name', 'discount_percentage', 'show_taxes', 'show_prices', 'users_count', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'name';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $groups = $query->orderBy($sortField, $sortDirection)->paginate(15)->withQueryString();

        return Inertia::render('Admin/CustomerGroups/Index', [
            'groups' => $groups,
            'filters' => $request->only(['search', 'sort_field', 'sort_direction'])
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Admin/CustomerGroups/Form', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'show_taxes' => 'required|boolean',
            'show_prices' => 'required|boolean',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $group = CustomerGroup::create($request->only(['name', 'discount_percentage', 'show_taxes', 'show_prices']));
        
        if ($request->has('category_ids')) {
            $group->categories()->sync($request->category_ids);
        } else {
            // Por defecto asigna todas las categorías
            $group->categories()->sync(Category::pluck('id'));
        }

        return redirect()->route('customer-groups.index')->with('success', 'Grupo creado con éxito.');
    }

    public function edit(CustomerGroup $customerGroup)
    {
        $customerGroup->load('categories');
        $categories = Category::all();
        return Inertia::render('Admin/CustomerGroups/Form', [
            'group' => $customerGroup,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, CustomerGroup $customerGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'show_taxes' => 'required|boolean',
            'show_prices' => 'required|boolean',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $customerGroup->update($request->only(['name', 'discount_percentage', 'show_taxes', 'show_prices']));
        
        if ($request->has('category_ids')) {
            $customerGroup->categories()->sync($request->category_ids);
        } else {
            $customerGroup->categories()->sync([]);
        }

        return redirect()->route('customer-groups.index')->with('success', 'Grupo actualizado con éxito.');
    }

    public function destroy(CustomerGroup $customerGroup)
    {
        if ($customerGroup->users()->count() > 0) {
            return redirect()->back()->with('error', 'No puedes eliminar un grupo que tiene clientes asignados.');
        }

        $customerGroup->delete();
        return redirect()->route('customer-groups.index')->with('success', 'Grupo eliminado con éxito.');
    }
}
