<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return Inertia::render('Admin/Orders/Index', [
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return Inertia::render('Admin/Orders/Show', [
            'order' => $order
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('message', 'Estado del pedido actualizado.');
    }
}
