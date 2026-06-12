<x-admin-layout title="সদস্য সম্পাদনা">
    <form method="POST" action="{{ route('admin.members.update', $member) }}" class="max-w-2xl rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
        @csrf
        @method('PUT')
        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label class="form-label" for="name">নাম <span class="text-red-500">*</span></label>
                <input id="name" name="name" type="text" value="{{ old('name', $member->name) }}" required class="form-input">
            </div>
            <div>
                <label class="form-label" for="father_name">পিতা/স্বামীর নাম</label>
                <input id="father_name" name="father_name" type="text" value="{{ old('father_name', $member->father_name) }}" class="form-input">
            </div>
            <div>
                <label class="form-label" for="phone">মোবাইল <span class="text-red-500">*</span></label>
                <input id="phone" name="phone" type="text" value="{{ old('phone', $member->phone) }}" required class="form-input">
            </div>
            <div>
                <label class="form-label" for="email">ইমেইল</label>
                <input id="email" name="email" type="email" value="{{ old('email', $member->email) }}" class="form-input">
            </div>
            <div>
                <label class="form-label" for="occupation">পেশা</label>
                <input id="occupation" name="occupation" type="text" value="{{ old('occupation', $member->occupation) }}" class="form-input">
            </div>
            <div>
                <label class="form-label" for="tier">সদস্যপদের ধরন <span class="text-red-500">*</span></label>
                <select id="tier" name="tier" class="form-select">
                    @foreach(\App\Models\Member::TIERS as $value => $label)
                        <option value="{{ $value }}" @selected(old('tier', $member->tier) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label" for="status">অবস্থা <span class="text-red-500">*</span></label>
                <select id="status" name="status" class="form-select">
                    @foreach(\App\Models\Member::STATUSES as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $member->status) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label" for="membership_no">সদস্য নম্বর <span class="text-xs font-normal text-gray-400">(অনুমোদনে স্বয়ংক্রিয়)</span></label>
                <input id="membership_no" name="membership_no" type="text" value="{{ old('membership_no', $member->membership_no) }}" class="form-input">
            </div>
            <div class="sm:col-span-2">
                <label class="form-label" for="address">ঠিকানা</label>
                <input id="address" name="address" type="text" value="{{ old('address', $member->address) }}" class="form-input">
            </div>
        </div>
        <div class="mt-6 flex gap-3">
            <button type="submit" class="btn-primary">সংরক্ষণ করুন</button>
            <a href="{{ route('admin.members.index') }}" class="btn-outline">বাতিল</a>
        </div>
    </form>
</x-admin-layout>
