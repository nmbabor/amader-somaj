<x-public-layout title="সদস্যপদ" metaDescription="আমাদের সমাজের সদস্য হোন এবং সমাজ গঠনে অংশ নিন।">
    <x-public.page-header title="সদস্যপদ"
        subtitle="আমাদের পরিবারের অংশ হোন, সমাজ বদলের অংশীদার হোন।" />

    {{-- Tiers --}}
    <section class="py-16">
        <div class="container-section">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="section-title">সদস্যপদের ধরন</h2>
                <p class="mt-3 text-gray-600">আপনার সামর্থ্য অনুযায়ী যেকোনো ক্যাটাগরিতে যুক্ত হতে পারেন।</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                @php
                    $tiers = [
                        ['name' => 'সাধারণ সদস্য', 'fee' => 'মাসিক ৳৫০', 'desc' => 'নিয়মিত মাসিক চাঁদার মাধ্যমে কার্যক্রমে অংশগ্রহণ।', 'featured' => false],
                        ['name' => 'আজীবন সদস্য', 'fee' => 'এককালীন ৳৫০০০', 'desc' => 'একবার পরিশোধে সারাজীবনের জন্য সদস্যপদ ও ভোটাধিকার।', 'featured' => true],
                        ['name' => 'দাতা সদস্য', 'fee' => 'স্বেচ্ছা অনুদান', 'desc' => 'বড় অনুদানের মাধ্যমে সংগঠনের পৃষ্ঠপোষকতা।', 'featured' => false],
                    ];
                @endphp
                @foreach($tiers as $tier)
                    <div class="card relative p-7 {{ $tier['featured'] ? 'ring-2 ring-brand-600' : '' }}">
                        @if($tier['featured'])
                            <span class="absolute right-5 top-5 rounded-full bg-brand-700 px-3 py-1 text-xs font-semibold text-white">জনপ্রিয়</span>
                        @endif
                        <h3 class="text-xl font-bold text-gray-900">{{ $tier['name'] }}</h3>
                        <p class="mt-2 text-2xl font-bold text-brand-700">{{ $tier['fee'] }}</p>
                        <p class="mt-3 text-sm leading-relaxed text-gray-600">{{ $tier['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Benefits + Form --}}
    <section class="bg-white py-16">
        <div class="container-section grid gap-12 lg:grid-cols-2">
            <div>
                <h2 class="section-title">সদস্য হলে যা পাবেন</h2>
                <ul class="mt-6 space-y-4">
                    @foreach([
                        'সংগঠনের সকল কার্যক্রমে সরাসরি অংশগ্রহণের সুযোগ',
                        'গণগ্রন্থাগার ও শিক্ষা কার্যক্রম ব্যবহারের অগ্রাধিকার',
                        'বার্ষিক সাধারণ সভায় ভোটাধিকার (আজীবন সদস্য)',
                        'সমাজসেবামূলক উদ্যোগে নেতৃত্ব দেওয়ার সুযোগ',
                        'সদস্যপদ সনদ ও পরিচয়পত্র',
                    ] as $benefit)
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-brand-100 text-brand-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            </span>
                            <span class="text-gray-700">{{ $benefit }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-2xl bg-brand-50 p-7 ring-1 ring-brand-100">
                <h2 class="text-xl font-bold text-gray-900">সদস্যপদের আবেদন ফরম</h2>
                <p class="mt-1 text-sm text-gray-600">নিচের তথ্যগুলো পূরণ করুন। আমরা যাচাই করে যোগাযোগ করব।</p>

                <x-flash />

                <form method="POST" action="{{ route('membership.store') }}" class="mt-5 space-y-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="form-label" for="name">নাম <span class="text-red-500">*</span></label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required class="form-input">
                        </div>
                        <div>
                            <label class="form-label" for="father_name">পিতা/স্বামীর নাম</label>
                            <input id="father_name" name="father_name" type="text" value="{{ old('father_name') }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label" for="phone">মোবাইল নম্বর <span class="text-red-500">*</span></label>
                            <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required class="form-input">
                        </div>
                        <div>
                            <label class="form-label" for="email">ইমেইল</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label" for="occupation">পেশা</label>
                            <input id="occupation" name="occupation" type="text" value="{{ old('occupation') }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label" for="tier">সদস্যপদের ধরন <span class="text-red-500">*</span></label>
                            <select id="tier" name="tier" required class="form-select">
                                @foreach(\App\Models\Member::TIERS as $value => $label)
                                    <option value="{{ $value }}" @selected(old('tier') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="form-label" for="address">ঠিকানা</label>
                        <input id="address" name="address" type="text" value="{{ old('address') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="message">আপনার বার্তা (ঐচ্ছিক)</label>
                        <textarea id="message" name="message" rows="3" class="form-textarea">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn-primary w-full">আবেদন জমা দিন</button>
                </form>
            </div>
        </div>
    </section>
</x-public-layout>
