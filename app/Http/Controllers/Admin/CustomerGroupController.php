<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerGroup;
use App\Models\Category;
use Inertia\Inertia;

class CustomerGroupController extends Controller
{
    public function index()
    {
        $groups = CustomerGroup::withCount('users')->get();
        return Inertia::render('Admin/CustomerGroups/Index', [
            'groups' => $groups
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
