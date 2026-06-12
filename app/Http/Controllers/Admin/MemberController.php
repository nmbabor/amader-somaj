<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::query()
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('q'), fn ($q) => $q->where(function ($w) use ($request) {
                $w->where('name', 'like', '%'.$request->q.'%')
                  ->orWhere('phone', 'like', '%'.$request->q.'%');
            }))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.members.index', compact('members'));
    }

    public function show(Member $member)
    {
        return view('admin.members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'tier' => ['required', 'in:'.implode(',', array_keys(Member::TIERS))],
            'status' => ['required', 'in:'.implode(',', array_keys(Member::STATUSES))],
            'membership_no' => ['nullable', 'string', 'max:50'],
        ]);

        // Auto-assign a membership number and join date on first approval.
        if ($data['status'] === 'approved' && ! $member->membership_no && empty($data['membership_no'])) {
            $data['membership_no'] = 'AS-'.str_pad((string) ($member->id), 5, '0', STR_PAD_LEFT);
            $data['joined_at'] = now();
        }

        $member->update($data);

        return redirect()->route('admin.members.index')->with('success', 'সদস্যের তথ্য হালনাগাদ হয়েছে।');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return back()->with('success', 'সদস্য মুছে ফেলা হয়েছে।');
    }
}
