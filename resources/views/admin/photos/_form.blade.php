@csrf
<div class="space-y-5">
    <div>
        <label class="form-label" for="title">শিরোনাম <span class="text-red-500">*</span></label>
        <input id="title" name="title" type="text" value="{{ old('title', $photo->title ?? '') }}" required class="form-input">
    </div>
    <div>
        <label class="form-label" for="category_id">ক্যাটাগরি</label>
        <select id="category_id" name="category_id" class="form-select">
            <option value="">— নির্বাচন করুন —</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $photo->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
        <p class="mt-1 text-xs text-gray-400">ছবির ক্যাটাগরি না থাকলে <a href="{{ route('admin.categories.create') }}" class="text-brand-600 underline">এখানে</a> তৈরি করুন (ধরন: ছবি)।</p>
    </div>
    <div>
        <label class="form-label" for="caption">ক্যাপশন</label>
        <textarea id="caption" name="caption" rows="2" class="form-textarea">{{ old('caption', $photo->caption ?? '') }}</textarea>
    </div>
    <div>
        <label class="form-label" for="image">ছবি @if(empty($photo))<span class="text-red-500">*</span>@endif</label>
        @if(! empty($photo) && $photo->getFirstMedia('image'))
            <img src="{{ $photo->thumb_url }}" alt="" class="mb-3 h-32 w-32 rounded-lg object-cover">
        @endif
        <input id="image" name="image" type="file" accept="image/*" @if(empty($photo)) required @endif
               class="form-input file:mr-3 file:rounded-md file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-brand-700">
        <p class="mt-1 text-xs text-gray-400">সর্বোচ্চ ৬ MB। @if(! empty($photo)) নতুন ছবি দিলে আগেরটি প্রতিস্থাপিত হবে। @endif</p>
    </div>
    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
        <input type="checkbox" name="is_published" value="1" class="rounded border-gray-300 text-brand-600 focus:ring-brand-500"
            @checked(old('is_published', $photo->is_published ?? true))>
        প্রকাশ করুন
    </label>
    <div class="flex gap-3">
        <button type="submit" class="btn-primary">সংরক্ষণ করুন</button>
        <a href="{{ route('admin.photos.index') }}" class="btn-outline">বাতিল</a>
    </div>
</div>
