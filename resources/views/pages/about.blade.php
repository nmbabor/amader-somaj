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

    {{-- Team --}}
    <section class="hidden py-16">
        <div class="container-section">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="section-title">আমাদের পরিচালনা পর্ষদ</h2>
                <p class="mt-3 text-gray-600">যাঁদের নিরলস পরিশ্রমে এগিয়ে চলেছে আমাদের সমাজ।</p>
            </div>

            @if($team->isEmpty())
                <p class="mt-10 rounded-xl bg-gray-50 p-8 text-center text-gray-500">শীঘ্রই পরিচালনা পর্ষদের তথ্য যুক্ত করা হবে।</p>
            @else
                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($team as $member)
                        <div class="card p-6 text-center">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}"
                                 class="mx-auto h-28 w-28 rounded-full object-cover ring-4 ring-brand-50">
                            <h3 class="mt-4 text-lg font-bold text-gray-900">{{ $member->name }}</h3>
                            <p class="text-sm font-medium text-brand-700">{{ $member->designation }}</p>
                            @if($member->bio)
                                <p class="mt-2 text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($member->bio, 80) }}</p>
                            @endif
                            <div class="mt-3 flex justify-center gap-2">
                                @if($member->facebook)
                                    <a href="{{ $member->facebook }}" target="_blank" rel="noopener" class="text-gray-400 hover:text-brand-700" aria-label="Facebook">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                                    </a>
                                @endif
                                @if($member->phone)
                                    <a href="tel:{{ $member->phone }}" class="text-gray-400 hover:text-brand-700" aria-label="Phone">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-public-layout>
