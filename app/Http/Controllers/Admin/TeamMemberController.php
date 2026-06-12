<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::with('media')->orderBy('sort_order')->paginate(20);

        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['is_active'] = $request->boolean('is_active');

        $member = TeamMember::create($data);

        if ($request->hasFile('photo')) {
            $member->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return redirect()->route('admin.team-members.index')->with('success', 'সদস্য যুক্ত হয়েছে।');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team.edit', ['member' => $teamMember]);
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $data = $this->validateData($request);
        $data['is_active'] = $request->boolean('is_active');

        $teamMember->update($data);

        if ($request->hasFile('photo')) {
            $teamMember->clearMediaCollection('photo');
            $teamMember->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return redirect()->route('admin.team-members.index')->with('success', 'সদস্যের তথ্য হালনাগাদ হয়েছে।');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return back()->with('success', 'সদস্য মুছে ফেলা হয়েছে।');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'photo' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}
