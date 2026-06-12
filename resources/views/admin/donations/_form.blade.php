@csrf
<div class="grid gap-5 sm:grid-cols-2">
    <div>
        <label class="form-label" for="donor_name">দাতার নাম <span class="text-red-500">*</span></label>
        <input id="donor_name" name="donor_name" type="text" value="{{ old('donor_name', $donation->donor_name ?? '') }}" required class="form-input">
    </div>
    <div>
        <label class="form-label" for="amount">পরিমাণ (৳) <span class="text-red-500">*</span></label>
        <input id="amount" name="amount" type="number" min="1" step="0.01" value="{{ old('amount', $donation->amount ?? '') }}" required class="form-input">
    </div>
    <div>
        <label class="form-label" for="phone">মোবাইল</label>
        <input id="phone" name="phone" type="text" value="{{ old('phone', $donation->phone ?? '') }}" class="form-input">
    </div>
    <div>
        <label class="form-label" for="email">ইমেইল</label>
        <input id="email" name="email" type="email" value="{{ old('email', $donation->email ?? '') }}" class="form-input">
    </div>
    <div>
        <label class="form-label" for="method">মাধ্যম <span class="text-red-500">*</span></label>
        <select id="method" name="method" class="form-select">
            @foreach(\App\Models\Donation::METHODS as $value => $label)
                <option value="{{ $value }}" @selected(old('method', $donation->method ?? 'bkash') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="form-label" for="status">অবস্থা <span class="text-red-500">*</span></label>
        <select id="status" name="status" class="form-select">
            @foreach(\App\Models\Donation::STATUSES as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $donation->status ?? 'pending') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="form-label" for="transaction_id">ট্রানজেকশন আইডি</label>
        <input id="transaction_id" name="transaction_id" type="text" value="{{ old('transaction_id', $donation->transaction_id ?? '') }}" class="form-input">
    </div>
    <div>
        <label class="form-label" for="donated_at">অনুদানের তারিখ</label>
        <input id="donated_at" name="donated_at" type="date" value="{{ old('donated_at', isset($donation->donated_at) ? $donation->donated_at->format('Y-m-d') : '') }}" class="form-input">
    </div>
    <div class="sm:col-span-2">
        <label class="form-label" for="note">নোট</label>
        <textarea id="note" name="note" rows="2" class="form-textarea">{{ old('note', $donation->note ?? '') }}</textarea>
    </div>
</div>
<div class="mt-6 flex gap-3">
    <button type="submit" class="btn-primary">সংরক্ষণ করুন</button>
    <a href="{{ route('admin.donations.index') }}" class="btn-outline">বাতিল</a>
</div>
