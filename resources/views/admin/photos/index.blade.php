<x-admin-layout title="ছবি গ্যালারি">
    <div class="mb-5 flex items-center justify-between">
        <p class="text-sm text-gray-500">মোট {{ bn_number($photos->total()) }} টি ছবি</p>
        <a href="{{ route('admin.photos.create') }}" class="btn-primary">+ নতুন ছবি</a>
    </div>

    @if($photos->isEmpty())
        <div class="rounded-2xl bg-white p-12 text-center text-gray-400 ring-1 ring-gray-100">কোনো ছবি নেই।</div>
    @else
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            @foreach($photos as $photo)
                <div class="group overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-100">
                    <div class="relative aspect-square">
                        <img src="{{ $photo->thumb_url }}" alt="{{ $photo->title }}" class="h-full w-full object-cover">
                        @unless($photo->is_published)
                            <span class="absolute left-2 top-2 rounded bg-gray-900/70 px-1.5 py-0.5 text-[10px] text-white">অপ্রকাশিত</span>
                        @endunless
                        <div class="absolute inset-0 flex items-center justify-center gap-2 bg-black/40 opacity-0 transition group-hover:opacity-100">
                            <a href="{{ route('admin.photos.edit', $photo) }}" class="rounded-lg bg-white p-2 text-brand-700" title="সম্পাদনা">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                            </a>
                            <x-admin.delete-button :action="route('admin.photos.destroy', $photo)" />
                        </div>
                    </div>
                    <p class="truncate px-3 py-2 text-xs font-medium text-gray-700">{{ $photo->title }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-5">{{ $photos->links() }}</div>
    @endif
</x-admin-layout>
