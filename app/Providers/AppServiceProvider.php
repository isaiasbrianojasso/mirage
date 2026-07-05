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
            $mockBusinessSetting = (object) [
                'name' => \App\Models\CompanySetting::get('store_name', 'Mirage'),
                'logo_path' => \App\Models\CompanySetting::get('store_logo', '/tienda_assets/img/mirage-logo-1534899548.jpg')
            ];
            \Illuminate\Support\Facades\View::share('businessSetting', $mockBusinessSetting);
            \Illuminate\Support\Facades\View::share('categories', \App\Models\Category::with('children.children')
                ->where('is_active', true)
                ->whereNull('parent_id')
                ->get());
        } catch (\Exception $e) {
            // Ignore during initial migrations when table doesn't exist
            \Illuminate\Support\Facades\View::share('categories', collect([]));
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

        \Illuminate\Support\Facades\Event::listen(\Illuminate\Mail\Events\MessageSent::class, function (\Illuminate\Mail\Events\MessageSent $event) {
            try {
                $message = $event->message;
                $headers = $message->getHeaders();
                $subject = $message->getSubject() ?? 'Sin asunto';
                
                $recipients = [];
                foreach ($message->getTo() as $address) {
                    $recipients[] = $address->getAddress();
                }

                \App\Models\EmailLog::create([
                    'recipient' => implode(', ', $recipients),
                    'subject' => $subject,
                    'body' => $message->getHtmlBody() ?: $message->getTextBody() ?: 'Contenido no disponible',
                    'status' => 'sent',
                    // Note: Order ID linking could be done via a custom header if needed in the future
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Error logging email: ' . $e->getMessage());
            }
        });
    }
}
