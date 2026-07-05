<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead()
    {
        if (auth()->user()->role === 'admin') {
            \App\Models\EmailLog::whereNull('read_at')->update(['read_at' => now()]);
        } else {
            \App\Models\EmailLog::where('recipient', auth()->user()->email)->whereNull('read_at')->update(['read_at' => now()]);
        }

        return redirect()->back();
    }
}
