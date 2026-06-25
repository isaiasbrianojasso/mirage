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
        } catch (\Exception $e) {
            // Ignore during initial migrations when table doesn't exist
        }
    }
}
