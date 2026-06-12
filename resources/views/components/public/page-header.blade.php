@props([
    'title' => '',
    'subtitle' => null,
    'breadcrumb' => null,
])

<section class="relative overflow-hidden bg-brand-800 py-12 sm:py-16">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 20% 20%, white 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="container-section relative text-center text-white">
        <h1 class="text-3xl font-bold sm:text-4xl">{{ $title }}</h1>
        @if($subtitle)
            <p class="mx-auto mt-3 max-w-2xl text-brand-100">{{ $subtitle }}</p>
        @endif
        <nav class="mt-4 flex items-center justify-center gap-2 text-sm text-brand-200">
            <a href="{{ route('home') }}" class="hover:text-white">হোম</a>
            <span>/</span>
            <span class="text-white">{{ $breadcrumb ?? $title }}</span>
        </nav>
    </div>
</section>