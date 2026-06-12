<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        return view('pages.donation');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1'],
            'method' => ['required', 'in:'.implode(',', array_keys(Donation::METHODS))],
            'transaction_id' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:1000'],
        ], [], [
            'donor_name' => 'নাম',
            'amount' => 'পরিমাণ',
            'method' => 'মাধ্যম',
        ]);

        $validated['status'] = 'pending';
        $validated['donated_at'] = now();

        Donation::create($validated);

        return redirect()
            ->route('donation.index')
            ->with('success', 'আপনার অনুদানের তথ্য জমা হয়েছে। আপনার সহযোগিতার জন্য আন্তরিক ধন্যবাদ! যাচাইয়ের পর আমরা নিশ্চিত করব।');
    }
}
