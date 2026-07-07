<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class NewsletterController extends Controller
{
    public function create()
    {
        $subscriberCount = User::where('newsletter', true)->orWhere('opt_in', true)->count();
        
        return Inertia::render('Admin/Newsletter/Create', [
            'subscriberCount' => $subscriberCount
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $subscribers = User::where('newsletter', true)->orWhere('opt_in', true)->get();

        if ($subscribers->isEmpty()) {
            return redirect()->back()->with('error', 'No hay suscriptores para enviar el boletín.');
        }

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail($request->subject, $request->content));
        }

        return redirect()->back()->with('success', 'Boletín despachado con éxito. Los correos se están enviando en segundo plano.');
    }
}
