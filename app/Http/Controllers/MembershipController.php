<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        return view('pages.membership');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'tier' => ['required', 'in:'.implode(',', array_keys(Member::TIERS))],
            'message' => ['nullable', 'string', 'max:2000'],
        ], [], [
            'name' => 'নাম',
            'phone' => 'মোবাইল নম্বর',
            'tier' => 'সদস্যপদের ধরন',
        ]);

        $validated['status'] = 'pending';

        Member::create($validated);

        return redirect()
            ->route('membership.index')
            ->with('success', 'আপনার সদস্যপদের আবেদন সফলভাবে জমা হয়েছে। আমরা শীঘ্রই আপনার সাথে যোগাযোগ করব।');
    }
}
