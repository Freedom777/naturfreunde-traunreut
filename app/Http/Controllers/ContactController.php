<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:120'],
            'email'   => ['required', 'email', 'max:200'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        ContactMessage::create($data);

        // Optionally send notification email to admin
        // Mail::to(config('naturfreunde.contact_email'))->send(new ContactReceived($data));

        return redirect()
            ->to(route('home') . '#kontakt')
            ->with('success', 'Vielen Dank! Ihre Nachricht wurde gesendet.');
    }
}
