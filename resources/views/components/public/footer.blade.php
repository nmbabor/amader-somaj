@php
    $siteName = setting('site_name', 'আমাদের সমাজ');
    $facebook = setting('facebook_url');
    $youtube = setting('youtube_url');
    $phone = setting('contact_phone', '০১৭০০-০০০০০০');
    $email = setting('contact_email', 'info@amadersomaj.org');
    $address = setting('contact_address', '৭নং ধর্মপুর ইউনিয়ন, বাংলাদেশ');
    $logo = setting('site_logo');
@endphp

<footer class="bg-brand-900 text-brand-100">
    <div class="container-section py-12">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            {{-- About --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3">
                     @if($logo)
                        <img src="{{ asset('storage/'.$logo) }}" alt="{{ $siteName }}" class="h-auto w-auto">
                    @else
                        <span class="flex h-11 w-11 items-center justify-center rounded-full bg-white text-lg font-bold text-brand-800">আ</span>
                        <span class="text-lg font-bold text-white">{{ $siteName }}</span>
                    @endif
                    
                </div>
                <p class="mt-4 text-sm leading-relaxed text-brand-200">
                    {{ setting('footer_about', 'একটি গণগ্রন্থাগার দিয়ে শুরু হওয়া আমাদের এই সংগঠনের লক্ষ্য ইউনিয়নের উন্নয়ন, শিক্ষার্থী ও মানুষের পাশে দাঁড়ানো এবং সামাজিক সচেতনতা গড়ে তোলা।') }}
                </p>
            </div>

            {{-- Quick links --}}
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-white">দ্রুত লিংক</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white">আমাদের সম্পর্কে</a></li>
                    <li><a href="{{ route('activities.index') }}" class="hover:text-white">কার্যক্রম</a></li>
                    <li><a href="{{ route('gallery.photos') }}" class="hover:text-white">ছবি গ্যালারি</a></li>
                    <li><a href="{{ route('gallery.videos') }}" class="hover:text-white">ভিডিও গ্যালারি</a></li>
                    <li><a href="{{ route('membership.index') }}" class="hover:text-white">সদস্য হোন</a></li>
                </ul>
            </div>

            {{-- Get involved --}}
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-white">যুক্ত হোন</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ route('donation.index') }}" class="hover:text-white">অনুদান দিন</a></li>
                    <li><a href="{{ route('membership.index') }}" class="hover:text-white">সদস্যপদ গ্রহণ</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-white">যোগাযোগ করুন</a></li>
                </ul>
                <div class="mt-5 flex gap-3">
                    @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" rel="noopener" aria-label="Facebook" class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-800 transition hover:bg-white hover:text-brand-800">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                    @endif
                    @if($youtube)
                        <a href="{{ $youtube }}" target="_blank" rel="noopener" aria-label="YouTube" class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-800 transition hover:bg-white hover:text-brand-800">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Contact --}}
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-white">যোগাযোগ</h3>
                <ul class="mt-4 space-y-3 text-sm">
                    <li class="flex items-start gap-2">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        <span>{{ $address }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="hover:text-white">{{ $phone }}</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        <a href="mailto:{{ $email }}" class="hover:text-white">{{ $email }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-10 flex flex-col items-center justify-between gap-3 border-t border-brand-800 pt-6 text-sm text-brand-300 sm:flex-row">
            <p>© {{ bn_number(date('Y')) }} {{ $siteName }}। সর্বস্বত্ব সংরক্ষিত।</p>
            <p>ভালোবাসা ও সেবার বন্ধনে গড়া আমাদের সমাজ।</p>
        </div>
    </div>
</footer>