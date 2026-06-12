@props(['post'])

<article class="card flex flex-col">
    <a href="{{ route('activities.show', $post) }}" class="block aspect-[16/9] overflow-hidden">
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy"
             class="h-full w-full object-cover transition duration-300 hover:scale-105">
    </a>
    <div class="flex flex-1 flex-col p-5">
        <div class="flex items-center gap-3 text-xs text-gray-500">
            @if($post->category)
                <span class="rounded-full bg-brand-50 px-2.5 py-1 font-medium text-brand-700">{{ $post->category->name }}</span>
            @endif
            <span>{{ bn_number(optional($post->published_at)->format('d/m/Y')) }}</span>
        </div>
        <h3 class="mt-3 text-lg font-bold leading-snug text-gray-900">
            <a href="{{ route('activities.show', $post) }}" class="hover:text-brand-700">{{ $post->title }}</a>
        </h3>
        <p class="mt-2 flex-1 text-sm leading-relaxed text-gray-600">
            {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 110) }}
        </p>
        <a href="{{ route('activities.show', $post) }}" class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-brand-700 hover:text-brand-800">
            বিস্তারিত পড়ুন
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
        </a>
    </div>
</article>
