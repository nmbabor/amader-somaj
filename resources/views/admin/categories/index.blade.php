<x-admin-layout title="ক্যাটাগরি">
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-gray-500">মোট {{ bn_number($categories->total()) }} টি ক্যাটাগরি</p>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary">+ নতুন ক্যাটাগরি</a>
    </div>

    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-4 py-3">নাম</th>
                    <th class="px-4 py-3">স্লাগ</th>
                    <th class="px-4 py-3">ধরন</th>
                    <th class="px-4 py-3">ব্যবহার</th>
                    <th class="px-4 py-3 text-right">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categories as $cat)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $cat->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $cat->slug }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $cat->type === 'photo' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $cat->type === 'photo' ? 'ছবি' : 'পোস্ট' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ bn_number($cat->type === 'photo' ? $cat->photos_count : $cat->posts_count) }} টি</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="rounded-lg p-1.5 text-brand-600 hover:bg-brand-50" title="সম্পাদনা">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                </a>
                                <x-admin.delete-button :action="route('admin.categories.destroy', $cat)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-10 text-center text-gray-400">কোনো ক্যাটাগরি নেই।</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $categories->links() }}</div>
</x-admin-layout>
