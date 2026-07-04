<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Distributor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Métricas rápidas
        $currentMonth = Carbon::now()->month;
        
        $totalSales = Order::whereMonth('created_at', $currentMonth)
            ->whereIn('payment_status', ['paid'])
            ->sum('total_amount');

        $totalOrders = Order::whereMonth('created_at', $currentMonth)
            ->whereIn('payment_status', ['paid'])
            ->count();

        $averageTicket = $totalOrders > 0 ? $totalSales / $totalOrders : 0;

        $activeOrders = Order::whereIn('status', ['pending', 'processing'])->count();
        
        $totalCustomers = User::where('role', 'customer')->count();

        $lowStockProducts = Product::where('stock', '<', 5)->where('is_active', true)->count();

        // Ventas recientes
        $recentOrders = Order::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Distribuidores Recientes (MVP)
        $recentDistributors = Distributor::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'metrics' => [
                'total_sales' => $totalSales,
                'total_orders' => $totalOrders,
                'average_ticket' => $averageTicket,
                'active_orders' => $activeOrders,
                'total_customers' => $totalCustomers,
                'low_stock_products' => $lowStockProducts,
            ],
            'recent_orders' => $recentOrders,
            'recent_distributors' => $recentDistributors,
        ]);
    }
}
