<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ setting('site_name', config('app.name', 'Laravel')) }}</title>

        @php $favicon = setting('site_favicon'); @endphp
        <link rel="icon" href="{{ $favicon ? asset('storage/'.$favicon) : asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-bangla text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            @php $logo = setting('site_logo'); @endphp
            <a href="{{ url('/') }}" class="flex flex-col items-center gap-3">
                @if($logo)
                    <img src="{{ asset('storage/'.$logo) }}" alt="{{ setting('site_name', 'আমাদের সমাজ') }}" class="h-16 w-auto">
                @else
                    <span class="flex h-16 w-16 items-center justify-center rounded-full bg-brand-700 text-2xl font-bold text-white shadow">আ</span>
                    <span class="text-lg font-bold text-brand-800">{{ setting('site_name', 'আমাদের সমাজ') }}</span>
                @endif
            </a>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
