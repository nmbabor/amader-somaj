<x-public-layout>
    {{-- ===== Hero ===== --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-800 via-brand-700 to-brand-900 text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 15% 20%, white 1.5px, transparent 1.5px); background-size: 32px 32px;"></div>
        <div class="container-section relative grid items-center gap-10 py-16 lg:grid-cols-2 lg:py-24">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-sm font-medium ring-1 ring-white/20">
                    <span class="h-2 w-2 rounded-full bg-brand-300"></span>
                    {{ setting('site_tagline', '৭নং ধর্মপুর ইউনিয়ন') }}
                </span>
                <h1 class="mt-5 text-4xl font-bold leading-tight sm:text-5xl">
                    {{ setting('hero_title', 'আমরা গড়ি আলোকিত সমাজ') }}
                </h1>
                <p class="mt-5 max-w-xl text-lg leading-relaxed text-brand-100">
                    {{ setting('hero_subtitle', 'একটি গণগ্রন্থাগার দিয়ে যাত্রা শুরু। আমাদের লক্ষ্য — ইউনিয়নের উন্নয়ন, শিক্ষার্থী ও মানুষের পাশে দাঁড়ানো, সামাজিক সচেতনতা এবং সম্মিলিত উদ্যোগে একটি সুন্দর আগামী।') }}
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('donation.index') }}" class="btn-white">দান করুন</a>
                    <a href="{{ route('membership.index') }}" class="btn border border-white/40 text-white hover:bg-white/10">সদস্য হোন</a>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-[4/3] overflow-hidden rounded-3xl bg-white/10 ring-1 ring-white/20 shadow-2xl">
                    <img src="{{ setting('hero_image') ? asset('storage/'.setting('hero_image')) : 'https://placehold.co/800x600/15803d/ffffff?text=' . urlencode('আমাদের সমাজ') }}"
                         alt="আমাদের সমাজ" class="h-full w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Stats counter ===== --}}
    <section class="border-b border-gray-100 bg-white py-12">
        <div class="container-section">
            <div class="grid grid-cols-2 gap-6 lg:grid-cols-4">
                @php
                    $items = [
                        ['value' => $stats['members'], 'label' => 'অনুমোদিত সদস্য', 'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
                        ['value' => $stats['posts'], 'label' => 'কার্যক্রম প্রকাশিত', 'icon' => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z'],
                        ['value' => $stats['donations'], 'label' => 'সংগৃহীত তহবিল (৳)', 'icon' => 'M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['value' => $stats['years'], 'label' => 'বছরের পথচলা', 'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'],
                    ];
                @endphp
                @foreach($items as $item)
                    <div x-data="{ shown: false, n: 0, target: {{ $item['value'] }} }"
                         x-init="
                            let io = new IntersectionObserver((e) => {
                                if (e[0].isIntersecting && !shown) {
                                    shown = true;
                                    let step = Math.max(1, Math.ceil(target / 40));
                                    let t = setInterval(() => { n = Math.min(target, n + step); if (n >= target) clearInterval(t); }, 25);
                                }
                            });
                            io.observe($el);
                         "
                         class="rounded-2xl bg-brand-50 p-6 text-center ring-1 ring-brand-100">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-brand-700 text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/></svg>
                        </div>
                        <div class="mt-4 text-3xl font-bold text-brand-800">
                            <span x-text="new Intl.NumberFormat('bn-BD').format(n)">০</span>+
                        </div>
                        <p class="mt-1 text-sm text-gray-600">{{ $item['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== Mission / What we do ===== --}}
    <section class="py-16">
        <div class="container-section">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="section-title">আমাদের লক্ষ্য ও কার্যক্রম</h2>
                <p class="mt-3 text-gray-600">শিক্ষা, সেবা ও সচেতনতার মাধ্যমে একটি আত্মনির্ভরশীল সমাজ গড়ে তোলাই আমাদের অঙ্গীকার।</p>
            </div>
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $features = [
                        ['t' => 'গণগ্রন্থাগার', 'd' => 'জ্ঞানের আলো ছড়িয়ে দিতে সকলের জন্য উন্মুক্ত পাঠাগার ও বই সংগ্রহ।', 'i' => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25'],
                        ['t' => 'শিক্ষা সহায়তা', 'd' => 'মেধাবী ও দরিদ্র শিক্ষার্থীদের পাশে দাঁড়ানো, শিক্ষা উপকরণ ও বৃত্তি প্রদান।', 'i' => 'M4.26 10.147a60.438 60.438 0 00-.491 6.347A48.62 48.62 0 0112 20.904a48.62 48.62 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.636 50.636 0 00-2.658-.813A59.906 59.906 0 0112 3.493a59.903 59.903 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5'],
                        ['t' => 'সমাজ উন্নয়ন', 'd' => 'ইউনিয়নের অবকাঠামো, স্বাস্থ্য ও পরিবেশ উন্নয়নে সম্মিলিত উদ্যোগ।', 'i' => 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z'],
                        ['t' => 'সামাজিক সচেতনতা', 'd' => 'মাদক, বাল্যবিবাহ ও কুসংস্কারের বিরুদ্ধে সচেতনতা ও প্রচারণা।', 'i' => 'M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46'],
                    ];
                @endphp
                @foreach($features as $f)
                    <div class="card p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-100 text-brand-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $f['i'] }}"/></svg>
                        </div>
                        <h3 class="mt-4 text-lg font-bold text-gray-900">{{ $f['t'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600">{{ $f['d'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== Recent activities ===== --}}
    <section class="bg-white py-16">
        <div class="container-section">
            <div class="flex items-end justify-between">
                <div>
                    <h2 class="section-title">সাম্প্রতিক কার্যক্রম</h2>
                    <p class="mt-2 text-gray-600">আমাদের সর্বশেষ খবর ও কার্যক্রমের আপডেট।</p>
                </div>
                <a href="{{ route('activities.index') }}" class="hidden text-sm font-semibold text-brand-700 hover:text-brand-800 sm:inline-flex">সব দেখুন →</a>
            </div>

            @if($recentPosts->isEmpty())
                <p class="mt-10 rounded-xl bg-gray-50 p-8 text-center text-gray-500">শীঘ্রই কার্যক্রম যুক্ত করা হবে।</p>
            @else
                <div class="mt-10 grid gap-6 md:grid-cols-3">
                    @foreach($recentPosts as $post)
                        <x-public.post-card :post="$post" />
                    @endforeach
                </div>
            @endif
            <div class="mt-8 text-center sm:hidden">
                <a href="{{ route('activities.index') }}" class="btn-outline">সব কার্যক্রম দেখুন</a>
            </div>
        </div>
    </section>

    {{-- ===== Photo preview ===== --}}
    @if($photos->isNotEmpty())
        <section class="py-16">
            <div class="container-section">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="section-title">ছবি গ্যালারি</h2>
                    <p class="mt-3 text-gray-600">আমাদের কার্যক্রমের কিছু মুহূর্ত।</p>
                </div>
                <div class="mt-10 grid grid-cols-2 gap-3 sm:grid-cols-4">
                    @foreach($photos as $photo)
                        <a href="{{ route('gallery.photos') }}" class="group relative aspect-square overflow-hidden rounded-xl">
                            <img src="{{ $photo->thumb_url }}" alt="{{ $photo->title }}" loading="lazy"
                                 class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 transition group-hover:opacity-100"></div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-8 text-center">
                    <a href="{{ route('gallery.photos') }}" class="btn-outline">পুরো গ্যালারি দেখুন</a>
                </div>
            </div>
        </section>
    @endif

    {{-- ===== CTA band ===== --}}
    <section class="bg-brand-800">
        <div class="container-section py-14 text-center text-white">
            <h2 class="text-2xl font-bold sm:text-3xl">আপনার সহযোগিতায় বদলে যাবে আমাদের সমাজ</h2>
            <p class="mx-auto mt-3 max-w-2xl text-brand-100">ছোট ছোট উদ্যোগ মিলেই বড় পরিবর্তন। আজই আমাদের সাথে যুক্ত হোন কিংবা একটি অনুদান দিয়ে পাশে দাঁড়ান।</p>
            <div class="mt-7 flex flex-wrap justify-center gap-3">
                <a href="{{ route('donation.index') }}" class="btn-white">এখনই দান করুন</a>
                <a href="{{ route('membership.index') }}" class="btn border border-white/40 text-white hover:bg-white/10">সদস্য হোন</a>
            </div>
        </div>
    </section>
</x-public-layout>
