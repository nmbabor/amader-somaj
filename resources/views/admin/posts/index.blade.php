<x-admin-layout title="কার্যক্রম / পোস্ট">
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-gray-500">মোট {{ bn_number($posts->total()) }} টি পোস্ট</p>
        <a href="{{ route('admin.posts.create') }}" class="btn-primary">+ নতুন পোস্ট</a>
    </div>

    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-4 py-3">শিরোনাম</th>
                        <th class="px-4 py-3">ক্যাটাগরি</th>
                        <th class="px-4 py-3">অবস্থা</th>
                        <th class="px-4 py-3">তারিখ</th>
                        <th class="px-4 py-3 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $post->image_url }}" alt="" class="h-10 w-14 rounded object-cover">
                                    <span class="font-medium text-gray-900">{{ \Illuminate\Support\Str::limit($post->title, 45) }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $post->category?->name ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @if($post->is_published)
                                    <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">প্রকাশিত</span>
                                @else
                                    <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600">খসড়া</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ bn_number(optional($post->published_at ?? $post->created_at)->format('d/m/Y')) }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('activities.show', $post) }}" target="_blank" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100" title="দেখুন">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="rounded-lg p-1.5 text-brand-600 hover:bg-brand-50" title="সম্পাদনা">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                    </a>
                                    <x-admin.delete-button :action="route('admin.posts.destroy', $post)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-gray-400">কোনো পোস্ট নেই। নতুন পোস্ট যোগ করুন।</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">{{ $posts->links() }}</div>
</x-admin-layout>
