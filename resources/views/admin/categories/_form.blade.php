@csrf
<div class="space-y-5">
    <div>
        <label class="form-label" for="name">নাম <span class="text-red-500">*</span></label>
        <input id="name" name="name" type="text" value="{{ old('name', $category->name ?? '') }}" required class="form-input">
    </div>
    <div>
        <label class="form-label" for="slug">স্লাগ <span class="text-xs font-normal text-gray-400">(খালি রাখলে স্বয়ংক্রিয়)</span></label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $category->slug ?? '') }}" class="form-input">
    </div>
    <div>
        <label class="form-label" for="type">ধরন <span class="text-red-500">*</span></label>
        <select id="type" name="type" required class="form-select">
            <option value="post" @selected(old('type', $category->type ?? 'post') === 'post')>পোস্ট / কার্যক্রম</option>
            <option value="photo" @selected(old('type', $category->type ?? '') === 'photo')>ছবি গ্যালারি</option>
        </select>
    </div>
    <div>
        <label class="form-label" for="description">বিবরণ</label>
        <textarea id="description" name="description" rows="3" class="form-textarea">{{ old('description', $category->description ?? '') }}</textarea>
    </div>
    <div class="flex gap-3">
        <button type="submit" class="btn-primary">সংরক্ষণ করুন</button>
        <a href="{{ route('admin.categories.index') }}" class="btn-outline">বাতিল</a>
    </div>
</div>
