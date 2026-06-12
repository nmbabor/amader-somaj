<x-public-layout title="ছবি গ্যালারি" metaDescription="আমাদের সমাজের কার্যক্রমের ছবি গ্যালারি।">
    <x-public.page-header title="ছবি গ্যালারি"
        subtitle="আমাদের কার্যক্রমের কিছু স্মরণীয় মুহূর্ত।" />

    <section class="py-12" x-data="{ open: false, src: '', caption: '' }">
        <div class="container-section">
            {{-- Category filter --}}
            <div class="mb-8 flex flex-wrap justify-center gap-2">
                <a href="{{ route('gallery.photos') }}"
                   class="rounded-full px-4 py-1.5 text-sm font-medium {{ ! request('category') ? 'bg-brand-700 text-white' : 'bg-white text-gray-600 ring-1 ring-gray-200 hover:bg-gray-50' }}">
                    সব ছবি
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('gallery.photos', ['category' => $cat->slug]) }}"
                       class="rounded-full px-4 py-1.5 text-sm font-medium {{ request('category') === $cat->slug ? 'bg-brand-700 text-white' : 'bg-white text-gray-600 ring-1 ring-gray-200 hover:bg-gray-50' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            @if($photos->isEmpty())
                <div class="rounded-2xl bg-gray-50 p-12 text-center text-gray-500">কোনো ছবি পাওয়া যায়নি।</div>
            @else
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach($photos as $photo)
                        <button type="button"
                                @click="open = true; src = '{{ $photo->image_url }}'; caption = @js($photo->title)"
                                class="group relative aspect-square overflow-hidden rounded-xl bg-gray-100 text-left">
                            <img src="{{ $photo->thumb_url }}" alt="{{ $photo->title }}" loading="lazy"
                                 class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/60 to-transparent p-3 opacity-0 transition group-hover:opacity-100">
                                <span class="text-sm font-medium text-white">{{ $photo->title }}</span>
                            </div>
                        </button>
                    @endforeach
                </div>
                <div class="mt-10">{{ $photos->links() }}</div>
            @endif
        </div>

        {{-- Lightbox --}}
        <div x-show="open" x-cloak @keydown.escape.window="open = false"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" x-transition>
            <button @click="open = false" class="absolute right-5 top-5 text-white/80 hover:text-white" aria-label="বন্ধ করুন">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div @click.outside="open = false" class="max-h-[85vh] max-w-4xl">
                <img :src="src" :alt="caption" class="max-h-[80vh] rounded-lg object-contain">
                <p class="mt-3 text-center text-sm text-white/90" x-text="caption"></p>
            </div>
        </div>
    </section>
</x-public-layout>
