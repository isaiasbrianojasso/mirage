<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ... (if there was anything here) ...
        try {
            \Illuminate\Support\Facades\View::share('businessSetting', \App\Models\BusinessSetting::first());
            \Illuminate\Support\Facades\View::share('categories', \App\Models\Category::with('children')
                ->where('is_active', true)
                ->whereNull('parent_id')
                ->get());
        } catch (\Exception $e) {
            // Ignore during initial migrations when table doesn't exist
        }

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $cartCount = 0;
            $cartTotal = 0;
            foreach ($cart as $item) {
                if (isset($item['quantity']) && isset($item['price'])) {
                    $cartCount += $item['quantity'];
                    $cartTotal += $item['price'] * $item['quantity'];
                }
            }
            $view->with('cartCount', $cartCount)->with('cartTotal', $cartTotal);
        });
    }
}
