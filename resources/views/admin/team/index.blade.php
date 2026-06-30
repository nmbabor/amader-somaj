<x-admin-layout title="টিম মেম্বার">
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-gray-500">মোট {{ bn_number($total) }} জন সদস্য</p>
        <a href="{{ route('admin.team-members.create') }}" class="btn-primary">+ নতুন সদস্য</a>
    </div>

    @if($total === 0)
        <div class="rounded-2xl bg-white p-12 text-center text-gray-400 ring-1 ring-gray-100">কোনো টিম মেম্বার নেই।</div>
    @else
        <div class="space-y-8">
            @foreach($groups as $group)
                <section>
                    <div class="mb-3 flex items-center gap-2">
                        <h2 class="text-base font-bold text-gray-900">{{ $group['label'] }}</h2>
                        <span class="rounded-full bg-brand-50 px-2 py-0.5 text-xs font-medium text-brand-700">{{ bn_number($group['members']->count()) }}</span>
                    </div>

                    @if($group['members']->isEmpty())
                        <div class="rounded-xl bg-white p-4 text-sm text-gray-400 ring-1 ring-gray-100">এই বিভাগে কোনো সদস্য নেই।</div>
                    @else
                        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
                            <table class="w-full divide-y divide-gray-100 text-sm">
                                <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    <tr>
                                        <th class="px-4 py-3 text-center">ক্রম</th>
                                        <th class="px-4 py-3">সদস্য</th>
                                        <th class="px-4 py-3">পদবি</th>
                                        <th class="px-4 py-3 text-center">অবস্থা</th>
                                        <th class="px-4 py-3 text-right">অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($group['members'] as $member)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-center text-gray-500">{{ bn_number($member->sort_order) }}</td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="h-10 w-10 rounded-full object-cover ring-1 ring-brand-50">
                                                    <span class="font-medium text-gray-900">{{ $member->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-gray-600">{{ $member->designation }}</td>
                                            <td class="px-4 py-3 text-center">
                                                @if($member->is_active)
                                                    <span class="rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700">সক্রিয়</span>
                                                @else
                                                    <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-500">নিষ্ক্রিয়</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex justify-end gap-1">
                                                    <a href="{{ route('admin.team-members.edit', $member) }}" class="rounded-lg p-1.5 text-brand-600 hover:bg-brand-50" title="সম্পাদনা">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                                    </a>
                                                    <x-admin.delete-button :action="route('admin.team-members.destroy', $member)" />
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </section>
            @endforeach
        </div>
    @endif
</x-admin-layout>
