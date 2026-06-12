<x-admin-layout title="সদস্য">
    {{-- Filters --}}
    <form method="GET" class="mb-5 flex flex-wrap items-center gap-3">
        <div class="flex gap-1 rounded-lg bg-white p-1 ring-1 ring-gray-200">
            <a href="{{ route('admin.members.index') }}" class="rounded-md px-3 py-1.5 text-sm {{ ! request('status') ? 'bg-brand-700 text-white' : 'text-gray-600' }}">সব</a>
            @foreach(\App\Models\Member::STATUSES as $value => $label)
                <a href="{{ route('admin.members.index', ['status' => $value]) }}" class="rounded-md px-3 py-1.5 text-sm {{ request('status') === $value ? 'bg-brand-700 text-white' : 'text-gray-600' }}">{{ $label }}</a>
            @endforeach
        </div>
        <div class="relative">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="নাম বা ফোন খুঁজুন..." class="form-input w-64">
        </div>
        <button class="btn-outline">খুঁজুন</button>
    </form>

    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-4 py-3">নাম</th>
                        <th class="px-4 py-3">ফোন</th>
                        <th class="px-4 py-3">ধরন</th>
                        <th class="px-4 py-3">সদস্য নং</th>
                        <th class="px-4 py-3">অবস্থা</th>
                        <th class="px-4 py-3 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($members as $member)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $member->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $member->phone }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $member->tier_label }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $member->membership_no ?? '—' }}</td>
                            <td class="px-4 py-3"><x-admin.status-badge :status="$member->status" :label="$member->status_label" /></td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.members.show', $member) }}" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100" title="বিস্তারিত">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.members.edit', $member) }}" class="rounded-lg p-1.5 text-brand-600 hover:bg-brand-50" title="সম্পাদনা">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                    </a>
                                    <x-admin.delete-button :action="route('admin.members.destroy', $member)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">কোনো সদস্য পাওয়া যায়নি।</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">{{ $members->links() }}</div>
</x-admin-layout>
