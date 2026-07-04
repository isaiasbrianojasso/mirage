<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerGroup;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class CustomerController extends Controller
{
    public function index()
    {
        // Traemos todos los usuarios, ordenados por fecha de registro, y su grupo
        $customers = User::with('customerGroup')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Admin/Customers/Index', [
            'customers' => $customers
        ]);
    }

    public function create()
    {
        $groups = CustomerGroup::all();
        return Inertia::render('Admin/Customers/Form', [
            'groups' => $groups
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'social_title' => 'nullable|in:Mr.,Mrs.',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthday' => 'nullable|date',
            'is_enabled' => 'boolean',
            'newsletter' => 'boolean',
            'opt_in' => 'boolean',
            'role' => 'nullable|in:admin,user',
            'customer_group_id' => 'required|exists:customer_groups,id',
            'group_ids' => 'nullable|array',
            'group_ids.*' => 'exists:customer_groups,id',
        ]);

        $user = User::create([
            'social_title' => $request->social_title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'is_enabled' => $request->is_enabled ?? true,
            'newsletter' => $request->newsletter ?? false,
            'opt_in' => $request->opt_in ?? false,
            'role' => $request->role ?? 'user',
            'customer_group_id' => $request->customer_group_id,
        ]);

        if ($request->has('group_ids')) {
            $user->groups()->sync($request->group_ids);
        } else {
            // Si no envían grupos adicionales, al menos asignamos el default
            $user->groups()->sync([$request->customer_group_id]);
        }

        return redirect()->route('customers.index')->with('success', 'Cliente creado con éxito.');
    }

    public function edit(User $customer)
    {
        $customer->load('groups');
        $groups = CustomerGroup::all();
        return Inertia::render('Admin/Customers/Form', [
            'customer' => $customer,
            'groups' => $groups
        ]);
    }

    public function update(Request $request, User $customer)
    {
        $rules = [
            'social_title' => 'nullable|in:Mr.,Mrs.',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $customer->id,
            'birthday' => 'nullable|date',
            'is_enabled' => 'boolean',
            'newsletter' => 'boolean',
            'opt_in' => 'boolean',
            'role' => 'nullable|in:admin,user',
            'customer_group_id' => 'required|exists:customer_groups,id',
            'group_ids' => 'nullable|array',
            'group_ids.*' => 'exists:customer_groups,id',
        ];

        // Si se envió un nuevo password, lo validamos
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }

        $request->validate($rules);

        $customer->social_title = $request->social_title;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->name = $request->first_name . ' ' . $request->last_name;
        $customer->email = $request->email;
        $customer->birthday = $request->birthday;
        $customer->is_enabled = $request->is_enabled ?? true;
        $customer->newsletter = $request->newsletter ?? false;
        $customer->opt_in = $request->opt_in ?? false;
        $customer->role = $request->role ?? 'user';
        $customer->customer_group_id = $request->customer_group_id;
        
        if ($request->filled('password')) {
            $customer->password = Hash::make($request->password);
        }

        $customer->save();

        if ($request->has('group_ids')) {
            $customer->groups()->sync($request->group_ids);
        } else {
            $customer->groups()->sync([$request->customer_group_id]);
        }

        return redirect()->route('customers.index')->with('success', 'Cliente actualizado con éxito.');
    }

    public function destroy(User $customer)
    {
        // Opcional: prever lógica para no borrarse a sí mismo si es el admin activo
        if (auth()->id() === $customer->id) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propia cuenta de administrador.');
        }

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Cliente eliminado con éxito.');
    }
}
