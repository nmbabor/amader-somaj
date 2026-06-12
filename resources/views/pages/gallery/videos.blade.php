<x-public-layout title="ভিডিও গ্যালারি" metaDescription="আমাদের সমাজের কার্যক্রমের ভিডিও।">
    <x-public.page-header title="ভিডিও গ্যালারি"
        subtitle="আমাদের কার্যক্রমের ভিডিও সংগ্রহ।" />

    <section class="py-12" x-data="{ open: false, embed: '' }">
        <div class="container-section">
            @if($videos->isEmpty())
                <div class="rounded-2xl bg-gray-50 p-12 text-center text-gray-500">কোনো ভিডিও পাওয়া যায়নি।</div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($videos as $video)
                        <div class="card">
                            @if($video->type === 'youtube' && $video->youtube_id)
                                <button type="button" @click="open = true; embed = '{{ $video->embed_url }}?autoplay=1'"
                                        class="group relative block aspect-video w-full overflow-hidden">
                                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" loading="lazy"
                                         class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                    <span class="absolute inset-0 flex items-center justify-center bg-black/30 transition group-hover:bg-black/40">
                                        <span class="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 text-brand-700 shadow-lg">
                                            <svg class="ml-1 h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </span>
                                    </span>
                                </button>
                            @elseif($video->video_file_url)
                                <video controls poster="{{ $video->thumbnail_url }}" class="aspect-video w-full bg-black">
                                    <source src="{{ $video->video_file_url }}" type="video/mp4">
                                </video>
                            @else
                                <div class="aspect-video w-full bg-gray-100"></div>
                            @endif
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900">{{ $video->title }}</h3>
                                @if($video->description)
                                    <p class="mt-2 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($video->description, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-10">{{ $videos->links() }}</div>
            @endif
        </div>

        {{-- Video modal --}}
        <div x-show="open" x-cloak @keydown.escape.window="open = false; embed = ''"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" x-transition>
            <button @click="open = false; embed = ''" class="absolute right-5 top-5 text-white/80 hover:text-white" aria-label="বন্ধ করুন">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="aspect-video w-full max-w-4xl">
                <template x-if="open">
                    <iframe :src="embed" class="h-full w-full rounded-lg" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </template>
            </div>
        </div>
    </section>
</x-public-layout>
