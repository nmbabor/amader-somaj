<x-admin-layout title="টিম মেম্বার">
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-gray-500">মোট {{ bn_number($members->total()) }} জন সদস্য</p>
        <a href="{{ route('admin.team-members.create') }}" class="btn-primary">+ নতুন সদস্য</a>
    </div>

    @if($members->isEmpty())
        <div class="rounded-2xl bg-white p-12 text-center text-gray-400 ring-1 ring-gray-100">কোনো টিম মেম্বার নেই।</div>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($members as $member)
                <div class="rounded-2xl bg-white p-5 text-center shadow-sm ring-1 ring-gray-100">
                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="mx-auto h-20 w-20 rounded-full object-cover ring-2 ring-brand-50">
                    <h3 class="mt-3 font-bold text-gray-900">{{ $member->name }}</h3>
                    <p class="text-sm text-brand-700">{{ $member->designation }}</p>
                    <p class="mt-1 text-xs text-gray-400">ক্রম: {{ bn_number($member->sort_order) }} · {{ $member->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</p>
                    <div class="mt-3 flex justify-center gap-1">
                        <a href="{{ route('admin.team-members.edit', $member) }}" class="rounded-lg p-1.5 text-brand-600 hover:bg-brand-50" title="সম্পাদনা">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                        </a>
                        <x-admin.delete-button :action="route('admin.team-members.destroy', $member)" />
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5">{{ $members->links() }}</div>
    @endif
</x-admin-layout>
