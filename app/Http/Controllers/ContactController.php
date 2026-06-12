<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:3000'],
        ], [], [
            'name' => 'নাম',
            'message' => 'বার্তা',
        ]);

        Contact::create($validated);

        return redirect()
            ->route('contact.index')
            ->with('success', 'আপনার বার্তা পাঠানো হয়েছে। ধন্যবাদ! আমরা শীঘ্রই উত্তর দেব।');
    }
}
