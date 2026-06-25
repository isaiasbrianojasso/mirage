<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return Inertia::render('Customer/Orders', [
            'orders' => $orders
        ]);
    }

    public function orderShow($id)
    {
        $order = Order::with('items.product')->where('user_id', auth()->id())->findOrFail($id);
        return Inertia::render('Customer/OrderShow', [
            'order' => $order
        ]);
    }
}
