<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();
        
        $totalOrders = Order::where('user_id', $userId)->count();
        $recentOrders = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->take(3)->get();
        
        // Simular wishlist o tomar de bd real si existe modelo, usaremos array vacio o lo real
        $wishlistCount = \DB::table('wishlists')->where('user_id', $userId)->count() ?? 0;

        return Inertia::render('Customer/Dashboard', [
            'metrics' => [
                'total_orders' => $totalOrders,
                'wishlist_count' => $wishlistCount,
            ],
            'recent_orders' => $recentOrders
        ]);
    }

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

    public function notifications()
    {
        $logs = \App\Models\EmailLog::where('recipient', auth()->user()->email)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return Inertia::render('Customer/Notifications', [
            'logs' => $logs
        ]);
    }
}
