<x-public-layout title="ফান্ড সংগ্রহ / দান" metaDescription="আপনার অনুদানে এগিয়ে যাবে আমাদের সমাজ। বিকাশ ও নগদের মাধ্যমে দান করুন।">
    <x-public.page-header title="ফান্ড সংগ্রহ"
        subtitle="আপনার ছোট্ট অনুদানই হতে পারে কারো বড় পরিবর্তনের কারণ।" />

    <section class="py-16">
        <div class="container-section grid gap-10 lg:grid-cols-2">
            {{-- Payment instructions --}}
            <div>
                <h2 class="section-title">কীভাবে দান করবেন</h2>
                <p class="mt-3 text-gray-600">নিচের যেকোনো মাধ্যমে অনুদান পাঠিয়ে নিচের ফরমে তথ্য জমা দিন। আমরা যাচাই করে আপনাকে নিশ্চিত করব।</p>

                {{-- bKash --}}
                <div class="mt-6 overflow-hidden rounded-2xl ring-1 ring-gray-100">
                    <div class="flex items-center gap-3 bg-[#E2136E] px-5 py-4 text-white">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/20 font-bold">bKash</span>
                        <span class="text-lg font-bold">বিকাশ</span>
                    </div>
                    <div class="space-y-2 bg-white p-5 text-sm">
                        <div class="flex justify-between"><span class="text-gray-500">নম্বর (Personal)</span><span class="font-semibold text-gray-900">{{ setting('bkash_number', '০১৭০০-০০০০০০') }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-500">ধরন</span><span class="font-medium text-gray-700">Send Money</span></div>
                        <p class="pt-2 text-gray-500">Send Money করে রেফারেন্সে আপনার নাম লিখুন। লেনদেন আইডি সংগ্রহ করে রাখুন।</p>
                    </div>
                </div>

                {{-- Nagad --}}
                <div class="mt-4 overflow-hidden rounded-2xl ring-1 ring-gray-100">
                    <div class="flex items-center gap-3 bg-[#F6921E] px-5 py-4 text-white">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/20 font-bold">নগদ</span>
                        <span class="text-lg font-bold">নগদ</span>
                    </div>
                    <div class="space-y-2 bg-white p-5 text-sm">
                        <div class="flex justify-between"><span class="text-gray-500">নম্বর (Personal)</span><span class="font-semibold text-gray-900">{{ setting('nagad_number', '০১৭০০-০০০০০০') }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-500">ধরন</span><span class="font-medium text-gray-700">Send Money</span></div>
                        <p class="pt-2 text-gray-500">Send Money সম্পন্ন করে লেনদেন আইডি সংরক্ষণ করুন।</p>
                    </div>
                </div>

                {{-- Bank --}}
                @if(setting('bank_info'))
                    <div class="mt-4 rounded-2xl bg-gray-50 p-5 text-sm ring-1 ring-gray-100">
                        <h3 class="font-bold text-gray-900">ব্যাংক একাউন্ট</h3>
                        <p class="mt-2 whitespace-pre-line text-gray-600">{{ setting('bank_info') }}</p>
                    </div>
                @endif

                <div class="mt-6 rounded-xl bg-brand-50 p-5 text-sm text-brand-800 ring-1 ring-brand-100">
                    <p>💚 আপনার প্রতিটি অনুদান স্বচ্ছতার সাথে ব্যবহৃত হয় — গ্রন্থাগার, শিক্ষা সহায়তা ও সমাজসেবায়।</p>
                </div>
            </div>

            {{-- Donation form --}}
            <div class="rounded-2xl bg-brand-50 p-7 ring-1 ring-brand-100">
                <h2 class="text-xl font-bold text-gray-900">অনুদানের তথ্য জমা দিন</h2>
                <p class="mt-1 text-sm text-gray-600">অনুদান পাঠানোর পর নিচের ফরমটি পূরণ করুন।</p>

                <x-flash />

                <form method="POST" action="{{ route('donation.store') }}" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label class="form-label" for="donor_name">আপনার নাম <span class="text-red-500">*</span></label>
                        <input id="donor_name" name="donor_name" type="text" value="{{ old('donor_name') }}" required class="form-input">
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="form-label" for="phone">মোবাইল নম্বর</label>
                            <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label" for="email">ইমেইল</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label" for="amount">পরিমাণ (৳) <span class="text-red-500">*</span></label>
                            <input id="amount" name="amount" type="number" min="1" step="1" value="{{ old('amount') }}" required class="form-input">
                        </div>
                        <div>
                            <label class="form-label" for="method">মাধ্যম <span class="text-red-500">*</span></label>
                            <select id="method" name="method" required class="form-select">
                                @foreach(\App\Models\Donation::METHODS as $value => $label)
                                    <option value="{{ $value }}" @selected(old('method') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="form-label" for="transaction_id">লেনদেন আইডি (Transaction ID)</label>
                        <input id="transaction_id" name="transaction_id" type="text" value="{{ old('transaction_id') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="note">বার্তা (ঐচ্ছিক)</label>
                        <textarea id="note" name="note" rows="2" class="form-textarea">{{ old('note') }}</textarea>
                    </div>
                    <button type="submit" class="btn-primary w-full">তথ্য জমা দিন</button>
                </form>
            </div>
        </div>
    </section>
</x-public-layout>
