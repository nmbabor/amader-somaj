@php
    $links = [
        ['route' => 'home', 'label' => 'হোম'],
        ['route' => 'about', 'label' => 'আমাদের সম্পর্কে'],
        ['route' => 'activities.index', 'label' => 'কার্যক্রম'],
        ['route' => 'gallery.photos', 'label' => 'ছবি গ্যালারি'],
        ['route' => 'gallery.videos', 'label' => 'ভিডিও গ্যালারি'],
        ['route' => 'membership.index', 'label' => 'সদস্যপদ'],
        ['route' => 'contact.index', 'label' => 'যোগাযোগ'],
    ];
    $siteName = setting('site_name', 'আমাদের সমাজ');
@endphp

<header x-data="{ open: false, scrolled: false }"
        @scroll.window="scrolled = (window.pageYOffset > 10)"
        class="sticky top-0 z-40 bg-white/95 backdrop-blur transition-shadow"
        :class="scrolled ? 'shadow-md' : 'shadow-sm'">
    <nav class="container-section">
        <div class="flex h-16 items-center justify-between lg:h-20">
            {{-- Brand --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-brand-700 text-lg font-bold text-white shadow">আ</span>
                <span class="leading-tight">
                    <span class="block text-lg font-bold text-brand-800">{{ $siteName }}</span>
                    <span class="block text-xs text-gray-500">{{ setting('site_tagline', '৭নং ধর্মপুর ইউনিয়ন') }}</span>
                </span>
            </a>

            {{-- Desktop nav --}}
            <div class="hidden items-center gap-1 lg:flex">
                @foreach($links as $link)
                    @php $active = request()->routeIs($link['route']) || ($link['route'] === 'activities.index' && request()->routeIs('activities.*')); @endphp
                    <a href="{{ route($link['route']) }}"
                       class="rounded-lg px-3 py-2 text-sm font-medium transition {{ $active ? 'text-brand-700' : 'text-gray-600 hover:bg-brand-50 hover:text-brand-700' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <a href="{{ route('donation.index') }}" class="btn-primary ml-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                    দান করুন
                </a>
            </div>

            {{-- Mobile toggle --}}
            <button @click="open = !open" class="inline-flex items-center justify-center rounded-lg p-2 text-gray-600 hover:bg-gray-100 lg:hidden" aria-label="মেনু">
                <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                <svg x-show="open" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div x-show="open" x-cloak x-transition class="border-t border-gray-100 pb-4 lg:hidden">
            <div class="flex flex-col gap-1 pt-2">
                @foreach($links as $link)
                    @php $active = request()->routeIs($link['route']); @endphp
                    <a href="{{ route($link['route']) }}"
                       class="rounded-lg px-3 py-2.5 text-sm font-medium {{ $active ? 'bg-brand-50 text-brand-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <a href="{{ route('donation.index') }}" class="btn-primary mt-2">দান করুন</a>
            </div>
        </div>
    </nav>
</header>