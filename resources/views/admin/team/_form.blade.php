@csrf
<div class="grid gap-5 sm:grid-cols-2">
    <div>
        <label class="form-label" for="name">নাম <span class="text-red-500">*</span></label>
        <input id="name" name="name" type="text" value="{{ old('name', $member->name ?? '') }}" required class="form-input">
    </div>
    <div>
        <label class="form-label" for="designation">পদবি <span class="text-red-500">*</span></label>
        <input id="designation" name="designation" type="text" value="{{ old('designation', $member->designation ?? '') }}" required class="form-input">
    </div>
    <div class="sm:col-span-2">
        <label class="form-label" for="bio">পরিচিতি</label>
        <textarea id="bio" name="bio" rows="3" class="form-textarea">{{ old('bio', $member->bio ?? '') }}</textarea>
    </div>
    <div>
        <label class="form-label" for="phone">ফোন</label>
        <input id="phone" name="phone" type="text" value="{{ old('phone', $member->phone ?? '') }}" class="form-input">
    </div>
    <div>
        <label class="form-label" for="email">ইমেইল</label>
        <input id="email" name="email" type="email" value="{{ old('email', $member->email ?? '') }}" class="form-input">
    </div>
    <div>
        <label class="form-label" for="facebook">Facebook URL</label>
        <input id="facebook" name="facebook" type="url" value="{{ old('facebook', $member->facebook ?? '') }}" class="form-input">
    </div>
    <div>
        <label class="form-label" for="linkedin">LinkedIn URL</label>
        <input id="linkedin" name="linkedin" type="url" value="{{ old('linkedin', $member->linkedin ?? '') }}" class="form-input">
    </div>
    <div>
        <label class="form-label" for="sort_order">ক্রম (sort order)</label>
        <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $member->sort_order ?? 0) }}" class="form-input">
    </div>
    <div>
        <label class="form-label" for="photo">ছবি</label>
        @if(! empty($member) && $member->getFirstMedia('photo'))
            <img src="{{ $member->photo_url }}" alt="" class="mb-2 h-16 w-16 rounded-full object-cover">
        @endif
        <input id="photo" name="photo" type="file" accept="image/*" class="form-input file:mr-3 file:rounded-md file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-brand-700">
    </div>
    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 sm:col-span-2">
        <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-brand-600 focus:ring-brand-500"
            @checked(old('is_active', $member->is_active ?? true))>
        সক্রিয় (ওয়েবসাইটে দেখাবে)
    </label>
</div>
<div class="mt-6 flex gap-3">
    <button type="submit" class="btn-primary">সংরক্ষণ করুন</button>
    <a href="{{ route('admin.team-members.index') }}" class="btn-outline">বাতিল</a>
</div>
