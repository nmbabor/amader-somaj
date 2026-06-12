<x-public-layout title="যোগাযোগ" metaDescription="আমাদের সমাজের সাথে যোগাযোগ করুন।">
    <x-public.page-header title="যোগাযোগ"
        subtitle="যেকোনো প্রশ্ন, পরামর্শ বা সহযোগিতার জন্য আমাদের সাথে যোগাযোগ করুন।" />

    <section class="py-16">
        <div class="container-section grid gap-10 lg:grid-cols-2">
            {{-- Info + form --}}
            <div>
                <h2 class="section-title">আমাদের সাথে কথা বলুন</h2>
                <div class="mt-6 space-y-4">
                    <div class="flex items-start gap-4 rounded-xl bg-white p-4 ring-1 ring-gray-100">
                        <span class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-lg bg-brand-100 text-brand-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        </span>
                        <div>
                            <p class="font-semibold text-gray-900">ঠিকানা</p>
                            <p class="text-sm text-gray-600">{{ setting('contact_address', '৭নং ধর্মপুর ইউনিয়ন, বাংলাদেশ') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 rounded-xl bg-white p-4 ring-1 ring-gray-100">
                        <span class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-lg bg-brand-100 text-brand-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        </span>
                        <div>
                            <p class="font-semibold text-gray-900">ফোন</p>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', setting('contact_phone', '01700000000')) }}" class="text-sm text-gray-600 hover:text-brand-700">{{ setting('contact_phone', '০১৭০০-০০০০০০') }}</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 rounded-xl bg-white p-4 ring-1 ring-gray-100">
                        <span class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-lg bg-brand-100 text-brand-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        </span>
                        <div>
                            <p class="font-semibold text-gray-900">ইমেইল</p>
                            <a href="mailto:{{ setting('contact_email', 'info@amadersomaj.org') }}" class="text-sm text-gray-600 hover:text-brand-700">{{ setting('contact_email', 'info@amadersomaj.org') }}</a>
                        </div>
                    </div>
                </div>

                <div class="mt-8 rounded-2xl bg-brand-50 p-6 ring-1 ring-brand-100">
                    <x-flash />
                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="form-label" for="name">নাম <span class="text-red-500">*</span></label>
                                <input id="name" name="name" type="text" value="{{ old('name') }}" required class="form-input">
                            </div>
                            <div>
                                <label class="form-label" for="phone">মোবাইল</label>
                                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="form-input">
                            </div>
                            <div>
                                <label class="form-label" for="email">ইমেইল</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input">
                            </div>
                            <div>
                                <label class="form-label" for="subject">বিষয়</label>
                                <input id="subject" name="subject" type="text" value="{{ old('subject') }}" class="form-input">
                            </div>
                        </div>
                        <div>
                            <label class="form-label" for="message">বার্তা <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="4" required class="form-textarea">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn-primary w-full">বার্তা পাঠান</button>
                    </form>
                </div>
            </div>

            {{-- Map --}}
            <div>
                <h2 class="section-title">আমাদের অবস্থান</h2>
                <div class="mt-6 aspect-square overflow-hidden rounded-2xl shadow ring-1 ring-gray-100 lg:aspect-auto lg:h-[600px]">
                    <iframe
                        src="{{ setting('map_embed', 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3650!2d90.4!3d23.8!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sbn!2sbd!4v1700000000000') }}"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
