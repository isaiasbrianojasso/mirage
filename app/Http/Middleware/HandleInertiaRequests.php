<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $notifications = [];
        $unreadCount = 0;

        if ($request->user()) {
            $query = \App\Models\EmailLog::query();
            
            if ($request->user()->role === 'admin') {
                $query->orderBy('created_at', 'desc');
            } else {
                $query->where('recipient', $request->user()->email)->orderBy('created_at', 'desc');
            }

            $notifications = $query->take(5)->get();
            
            if ($request->user()->role === 'admin') {
                $unreadCount = \App\Models\EmailLog::whereNull('read_at')->count();
            } else {
                $unreadCount = \App\Models\EmailLog::where('recipient', $request->user()->email)->whereNull('read_at')->count();
            }
        }

        return [
            ...parent::share($request),
            'notifications' => [
                'data' => $notifications,
                'unread_count' => $unreadCount
            ],
            'passkeys' => $request->user() ? $request->user()->passkeys()->get() : [],
            'google_maps_api_key' => \App\Models\CompanySetting::get('google_maps_api_key', env('GOOGLE_MAPS_API_KEY', 'AIzaSyBqTIZeFqSA4s0MyDia9OznTeN85KfpfS4')),
        ];
    }
}
