<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $donations = Donation::query()
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest('donated_at')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $totals = [
            'verified' => (int) Donation::verified()->sum('amount'),
            'pending' => Donation::where('status', 'pending')->count(),
        ];

        return view('admin.donations.index', compact('donations', 'totals'));
    }

    public function create()
    {
        return view('admin.donations.create');
    }

    public function store(Request $request)
    {
        Donation::create($this->validateData($request));

        return redirect()->route('admin.donations.index')->with('success', 'অনুদান যুক্ত হয়েছে।');
    }

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        return view('admin.donations.edit', compact('donation'));
    }

    public function update(Request $request, Donation $donation)
    {
        $donation->update($this->validateData($request));

        return redirect()->route('admin.donations.index')->with('success', 'অনুদান হালনাগাদ হয়েছে।');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();

        return back()->with('success', 'অনুদান মুছে ফেলা হয়েছে।');
    }

    private function validateData(Request $request): array
    {
        $data = $request->validate([
            'donor_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1'],
            'method' => ['required', 'in:'.implode(',', array_keys(Donation::METHODS))],
            'transaction_id' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:'.implode(',', array_keys(Donation::STATUSES))],
            'note' => ['nullable', 'string', 'max:1000'],
            'donated_at' => ['nullable', 'date'],
        ]);

        $data['donated_at'] = $data['donated_at'] ?? now();

        return $data;
    }
}
