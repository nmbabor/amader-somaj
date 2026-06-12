@props([
    'url' => null,
    'title' => '',
])

@php
    $shareUrl = $url ?? url()->current();
    $enc = urlencode($shareUrl);
    $encTitle = urlencode($title);
@endphp

<div class="flex items-center gap-2">
    <span class="text-sm font-medium text-gray-600">শেয়ার করুন:</span>

    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $enc }}" target="_blank" rel="noopener"
       aria-label="Facebook এ শেয়ার করুন"
       class="flex h-9 w-9 items-center justify-center rounded-full bg-[#1877F2] text-white transition hover:opacity-90">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
    </a>

    <a href="https://wa.me/?text={{ $encTitle }}%20{{ $enc }}" target="_blank" rel="noopener"
       aria-label="WhatsApp এ শেয়ার করুন"
       class="flex h-9 w-9 items-center justify-center rounded-full bg-[#25D366] text-white transition hover:opacity-90">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.413c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.519 5.27l-.999 3.648 3.97-1.017z"/></svg>
    </a>

    <a href="https://twitter.com/intent/tweet?url={{ $enc }}&text={{ $encTitle }}" target="_blank" rel="noopener"
       aria-label="X এ শেয়ার করুন"
       class="flex h-9 w-9 items-center justify-center rounded-full bg-black text-white transition hover:opacity-90">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
    </a>
</div>