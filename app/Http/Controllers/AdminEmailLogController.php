<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailLog;
use Inertia\Inertia;

class AdminEmailLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = EmailLog::query();

        if ($search) {
            $query->where('recipient', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return Inertia::render('Admin/EmailLogs/Index', [
            'logs' => $logs,
            'filters' => ['search' => $search]
        ]);
    }
}
