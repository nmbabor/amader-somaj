<x-admin-layout title="ভিডিও গ্যালারি">
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-gray-500">মোট {{ bn_number($videos->total()) }} টি ভিডিও</p>
        <a href="{{ route('admin.videos.create') }}" class="btn-primary">+ নতুন ভিডিও</a>
    </div>

    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-4 py-3">ভিডিও</th>
                    <th class="px-4 py-3">ধরন</th>
                    <th class="px-4 py-3">অবস্থা</th>
                    <th class="px-4 py-3 text-right">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($videos as $video)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $video->thumbnail_url }}" alt="" class="h-10 w-16 rounded object-cover">
                                <span class="font-medium text-gray-900">{{ \Illuminate\Support\Str::limit($video->title, 40) }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $video->type === 'youtube' ? 'bg-red-100 text-red-700' : 'bg-indigo-100 text-indigo-700' }}">
                                {{ $video->type === 'youtube' ? 'YouTube' : 'আপলোড' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($video->is_published)
                                <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">প্রকাশিত</span>
                            @else
                                <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600">খসড়া</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.videos.edit', $video) }}" class="rounded-lg p-1.5 text-brand-600 hover:bg-brand-50" title="সম্পাদনা">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                </a>
                                <x-admin.delete-button :action="route('admin.videos.destroy', $video)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400">কোনো ভিডিও নেই।</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $videos->links() }}</div>
</x-admin-layout>
