<x-public-layout :title="$post->title"
    :metaDescription="$post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 160)"
    :ogImage="$post->featured_image ? asset('storage/'.$post->featured_image) : null">

    <article>
        {{-- Hero --}}
        <header class="bg-brand-800 py-12 text-white">
            <div class="container-section max-w-3xl">
                <nav class="flex items-center gap-2 text-sm text-brand-200">
                    <a href="{{ route('home') }}" class="hover:text-white">হোম</a><span>/</span>
                    <a href="{{ route('activities.index') }}" class="hover:text-white">কার্যক্রম</a>
                </nav>
                <h1 class="mt-4 text-3xl font-bold leading-tight sm:text-4xl">{{ $post->title }}</h1>
                <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-brand-100">
                    @if($post->category)
                        <span class="rounded-full bg-white/10 px-3 py-1">{{ $post->category->name }}</span>
                    @endif
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75"/></svg>
                        {{ bn_number(optional($post->published_at)->format('d/m/Y')) }}
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ bn_number($post->views) }} বার পঠিত
                    </span>
                </div>
            </div>
        </header>

        <div class="container-section max-w-3xl py-12">
            <div class="aspect-[16/9] overflow-hidden rounded-2xl shadow">
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="h-full w-full object-cover">
            </div>

            <div class="prose-bangla mt-8 text-base text-gray-700">
                {!! \Illuminate\Support\Str::markdown($post->body) !!}
            </div>

            <div class="mt-10 flex flex-col items-start justify-between gap-4 border-t border-gray-100 pt-6 sm:flex-row sm:items-center">
                <x-public.social-share :title="$post->title" />
                <a href="{{ route('activities.index') }}" class="text-sm font-semibold text-brand-700 hover:text-brand-800">← সব কার্যক্রম</a>
            </div>
        </div>

        {{-- Related --}}
        @if($related->isNotEmpty())
            <section class="bg-white py-14">
                <div class="container-section">
                    <h2 class="section-title">আরও কার্যক্রম</h2>
                    <div class="mt-8 grid gap-6 md:grid-cols-3">
                        @foreach($related as $rel)
                            <x-public.post-card :post="$rel" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </article>
</x-public-layout>
