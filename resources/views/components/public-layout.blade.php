@props([
    'title' => null,
    'metaDescription' => null,
    'ogImage' => null,
])

@php
    $siteName = setting('site_name', 'আমাদের সমাজ');
    $pageTitle = $title ? $title . ' | ' . $siteName : $siteName . ' | ' . setting('site_tagline', '৭নং ধর্মপুর ইউনিয়ন');
    $desc = $metaDescription ?? setting('site_description', 'আমাদের সমাজ — ৭নং ধর্মপুর ইউনিয়নের একটি সামাজিক সংগঠন। গ্রন্থাগার, শিক্ষা সহায়তা, সমাজ উন্নয়ন ও সচেতনতামূলক কার্যক্রম।');
    $image = $ogImage ?? asset('images/og-default.jpg');
@endphp
<!DOCTYPE html>
<html lang="bn" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $desc }}">
    <meta name="keywords" content="আমাদের সমাজ, ধর্মপুর ইউনিয়ন, সামাজিক সংগঠন, গ্রন্থাগার, সমাজসেবা, Amader Somaj">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:locale" content="bn_BD">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $image }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $desc }}">
    <meta name="twitter:image" content="{{ $image }}">

    @php $favicon = setting('site_favicon'); @endphp
    <link rel="icon" href="{{ $favicon ? asset('storage/'.$favicon) : asset('favicon.ico') }}">

    {{-- Bengali fonts: Hind Siliguri + Noto Sans Bengali --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{ $head ?? '' }}
</head>
<body class="min-h-screen bg-gray-50 font-bangla text-gray-700">

    <x-public.navbar />

    <main>
        {{ $slot }}
    </main>

    <x-public.footer />

    {{-- Floating WhatsApp button --}}
    @php $whatsapp = preg_replace('/[^0-9]/', '', setting('whatsapp_number', '8801700000000')); @endphp
    @if($whatsapp)
        <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener"
           aria-label="WhatsApp এ যোগাযোগ করুন"
           class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-lg ring-4 ring-white/40 transition hover:scale-110">
            <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.413c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.519 5.27l-.999 3.648 3.97-1.017zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
        </a>
    @endif

    @stack('scripts')
</body>
</html>