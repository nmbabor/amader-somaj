@csrf
<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-5 lg:col-span-2">
        <div>
            <label class="form-label" for="title">শিরোনাম <span class="text-red-500">*</span></label>
            <input id="title" name="title" type="text" value="{{ old('title', $post->title ?? '') }}" required class="form-input">
        </div>
        <div>
            <label class="form-label" for="excerpt">সংক্ষিপ্ত বিবরণ</label>
            <textarea id="excerpt" name="excerpt" rows="2" class="form-textarea">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
            <p class="mt-1 text-xs text-gray-400">কার্ডে দেখানো হবে। খালি রাখলে মূল লেখা থেকে নেওয়া হবে।</p>
        </div>
        <div>
            <label class="form-label" for="body">মূল লেখা <span class="text-red-500">*</span> <span class="text-xs font-normal text-gray-400">(Markdown সমর্থিত)</span></label>
            <textarea id="body" name="body" rows="14" required class="form-textarea font-mono text-sm">{{ old('body', $post->body ?? '') }}</textarea>
        </div>
    </div>

    <div class="space-y-5">
        <div class="rounded-xl bg-gray-50 p-4 ring-1 ring-gray-100">
            <label class="form-label" for="category_id">ক্যাটাগরি</label>
            <select id="category_id" name="category_id" class="form-select">
                <option value="">— নির্বাচন করুন —</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $post->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>

            <div class="mt-4">
                <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                    <input type="checkbox" name="is_published" value="1" class="rounded border-gray-300 text-brand-600 focus:ring-brand-500"
                        @checked(old('is_published', $post->is_published ?? true))>
                    প্রকাশ করুন
                </label>
            </div>
        </div>

        <div class="rounded-xl bg-gray-50 p-4 ring-1 ring-gray-100">
            <label class="form-label" for="featured_image">ফিচার্ড ছবি</label>
            @if(! empty($post) && $post->featured_image)
                <img src="{{ $post->image_url }}" alt="" class="mb-3 aspect-video w-full rounded-lg object-cover">
            @endif
            <input id="featured_image" name="featured_image" type="file" accept="image/*" class="form-input file:mr-3 file:rounded-md file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-brand-700">
            <p class="mt-1 text-xs text-gray-400">সর্বোচ্চ ৪ MB।</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary flex-1">সংরক্ষণ করুন</button>
            <a href="{{ route('admin.posts.index') }}" class="btn-outline">বাতিল</a>
        </div>
    </div>
</div>
