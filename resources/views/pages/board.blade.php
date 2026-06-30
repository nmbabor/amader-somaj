<x-public-layout title="পরিচালনা পর্ষদ">
    <x-public.page-header title="পরিচালনা পর্ষদ"
        subtitle="যাঁদের নিরলস পরিশ্রমে এগিয়ে চলেছে আমাদের সমাজ।" />

    @if($groups->isEmpty())
        <section class="py-16">
            <div class="container-section">
                <p class="rounded-xl bg-gray-50 p-8 text-center text-gray-500">শীঘ্রই পরিচালনা পর্ষদের তথ্য যুক্ত করা হবে।</p>
            </div>
        </section>
    @else
        @foreach($groups as $group)
            <section class="py-12 {{ $loop->even ? 'bg-white' : '' }}">
                <div class="container-section">
                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="section-title">{{ $group['label'] }}</h2>
                    </div>

                    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach($group['members'] as $member)
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
                </div>
            </section>
        @endforeach
    @endif
</x-public-layout>
