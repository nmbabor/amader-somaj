@php
    $defaultHistory = 'আমাদের সমাজ যাত্রা শুরু করে ৭নং ধর্মপুর ইউনিয়নে একটি ছোট্ট গণগ্রন্থাগার দিয়ে। উদ্দেশ্য ছিল সহজ — গ্রামের শিক্ষার্থী ও সাধারণ মানুষের হাতে বই তুলে দেওয়া।'
        ."\n\n".'ধীরে ধীরে এই উদ্যোগ পরিণত হয় একটি সামাজিক আন্দোলনে। শিক্ষা সহায়তা, স্বাস্থ্য সচেতনতা, পরিবেশ রক্ষা ও দুঃস্থদের পাশে দাঁড়ানো — সবকিছুতেই আজ আমরা সক্রিয়।';
@endphp
<x-public-layout title="আমাদের সম্পর্কে">
    <x-public.page-header title="আমাদের সম্পর্কে"
        subtitle="জ্ঞানের আলো আর সেবার বন্ধনে গড়া আমাদের পথচলার গল্প।" />

    {{-- History --}}
    <section class="py-16">
        <div class="container-section grid items-center gap-12 lg:grid-cols-2">
            <div class="aspect-[4/3] overflow-hidden rounded-3xl shadow-lg">
                <img src="{{ setting('about_image') ? asset('storage/'.setting('about_image')) : 'https://placehold.co/700x520/166534/ffffff?text=' . urlencode('আমাদের গ্রন্থাগার') }}"
                     alt="আমাদের সমাজ" class="h-full w-full object-cover">
            </div>
            <div>
                <span class="text-sm font-semibold uppercase tracking-wider text-brand-700">আমাদের ইতিহাস</span>
                <h2 class="mt-2 section-title">একটি গ্রন্থাগার থেকে একটি আন্দোলন</h2>
                <div class="prose-bangla mt-5 text-gray-600">
                    {!! nl2br(e(setting('about_history', $defaultHistory))) !!}
                </div>
            </div>
        </div>
    </section>

    {{-- Mission / Vision --}}
    <section class="bg-white py-16">
        <div class="container-section grid gap-6 md:grid-cols-2">
            <div class="rounded-2xl bg-brand-50 p-8 ring-1 ring-brand-100">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-700 text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg>
                </div>
                <h3 class="mt-5 text-xl font-bold text-gray-900">আমাদের লক্ষ্য (Mission)</h3>
                <p class="mt-3 leading-relaxed text-gray-600">{{ setting('mission', 'শিক্ষা, সেবা ও সচেতনতার মাধ্যমে ইউনিয়নের প্রতিটি মানুষের জীবনমান উন্নয়ন এবং একটি আত্মনির্ভরশীল, সুশিক্ষিত ও মানবিক সমাজ গড়ে তোলা।') }}</p>
            </div>
            <div class="rounded-2xl bg-brand-50 p-8 ring-1 ring-brand-100">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-700 text-white">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="mt-5 text-xl font-bold text-gray-900">আমাদের স্বপ্ন (Vision)</h3>
                <p class="mt-3 leading-relaxed text-gray-600">{{ setting('vision', 'এমন একটি সমাজ যেখানে প্রতিটি শিশু শিক্ষার আলো পাবে, কোনো মানুষ অভাবে অসহায় থাকবে না এবং সবাই মিলেমিশে একটি সুন্দর, সুস্থ ও সচেতন জনপদ গড়ে তুলবে।') }}</p>
            </div>
        </div>
    </section>

    {{-- Board of directors CTA --}}
    <section class="py-16">
        <div class="container-section">
            <a href="{{ route('board') }}"
               class="group relative block overflow-hidden rounded-3xl bg-brand-700 p-8 text-white shadow-lg ring-1 ring-brand-800 transition hover:shadow-xl sm:p-12">
                <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white/10 transition group-hover:scale-110"></div>
                <div class="absolute -bottom-12 -left-8 h-40 w-40 rounded-full bg-white/5"></div>

                <div class="relative flex flex-col items-start gap-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-start gap-5">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 ring-1 ring-white/20">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                        </div>
                        <div>
                            <span class="text-sm font-semibold uppercase tracking-wider text-brand-100">নেতৃত্ব</span>
                            <h2 class="mt-1 text-2xl font-bold sm:text-3xl">আমাদের পরিচালনা পর্ষদ</h2>
                            <p class="mt-2 max-w-xl text-brand-50">যাঁদের নিরলস পরিশ্রমে এগিয়ে চলেছে আমাদের সমাজ — উপদেষ্টা প্যানেল থেকে সাধারণ সদস্য পর্যন্ত সবার পরিচিতি দেখুন।</p>
                        </div>
                    </div>
                    <span class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-white px-5 py-3 font-semibold text-brand-700 shadow transition group-hover:gap-3">
                        পর্ষদ দেখুন
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </span>
                </div>
            </a>
        </div>
    </section>
</x-public-layout>
