<x-public-layout title="কার্যক্রম" metaDescription="আমাদের সমাজের সর্বশেষ কার্যক্রম, খবর ও আপডেট।">
    <x-public.page-header title="আমাদের কার্যক্রম"
        subtitle="সর্বশেষ খবর, প্রতিবেদন ও কার্যক্রমের আপডেট।" />

    <section class="py-12">
        <div class="container-section">
            {{-- Filters --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('activities.index') }}"
                       class="rounded-full px-4 py-1.5 text-sm font-medium {{ ! request('category') ? 'bg-brand-700 text-white' : 'bg-white text-gray-600 ring-1 ring-gray-200 hover:bg-gray-50' }}">
                        সব
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('activities.index', ['category' => $cat->slug]) }}"
                           class="rounded-full px-4 py-1.5 text-sm font-medium {{ request('category') === $cat->slug ? 'bg-brand-700 text-white' : 'bg-white text-gray-600 ring-1 ring-gray-200 hover:bg-gray-50' }}">
                            {{ $cat->name }} ({{ bn_number($cat->posts_count) }})
                        </a>
                    @endforeach
                </div>
                <form method="GET" action="{{ route('activities.index') }}" class="relative">
                    @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="খুঁজুন..."
                           class="form-input w-full pr-10 sm:w-64">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400" aria-label="খুঁজুন">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </button>
                </form>
            </div>

            @if($posts->isEmpty())
                <div class="rounded-2xl bg-gray-50 p-12 text-center">
                    <p class="text-gray-500">কোনো কার্যক্রম পাওয়া যায়নি।</p>
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($posts as $post)
                        <x-public.post-card :post="$post" />
                    @endforeach
                </div>
                <div class="mt-10">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>
</x-public-layout>
