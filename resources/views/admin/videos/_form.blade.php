@csrf
<div class="space-y-5" x-data="{ type: '{{ old('type', $video->type ?? 'youtube') }}' }">
    <div>
        <label class="form-label" for="title">শিরোনাম <span class="text-red-500">*</span></label>
        <input id="title" name="title" type="text" value="{{ old('title', $video->title ?? '') }}" required class="form-input">
    </div>
    <div>
        <label class="form-label" for="description">বিবরণ</label>
        <textarea id="description" name="description" rows="3" class="form-textarea">{{ old('description', $video->description ?? '') }}</textarea>
    </div>
    <div>
        <label class="form-label">ভিডিওর ধরন <span class="text-red-500">*</span></label>
        <div class="flex gap-3">
            <label class="flex flex-1 cursor-pointer items-center gap-2 rounded-lg border p-3 text-sm" :class="type === 'youtube' ? 'border-brand-500 bg-brand-50' : 'border-gray-200'">
                <input type="radio" name="type" value="youtube" x-model="type" class="text-brand-600 focus:ring-brand-500">
                YouTube লিংক
            </label>
            <label class="flex flex-1 cursor-pointer items-center gap-2 rounded-lg border p-3 text-sm" :class="type === 'upload' ? 'border-brand-500 bg-brand-50' : 'border-gray-200'">
                <input type="radio" name="type" value="upload" x-model="type" class="text-brand-600 focus:ring-brand-500">
                ফাইল আপলোড
            </label>
        </div>
    </div>

    <div x-show="type === 'youtube'">
        <label class="form-label" for="youtube_id">YouTube লিংক বা ID</label>
        <input id="youtube_id" name="youtube_id" type="text" value="{{ old('youtube_id', $video->youtube_id ?? '') }}" placeholder="https://youtu.be/XXXXXXXXXXX" class="form-input">
        <p class="mt-1 text-xs text-gray-400">পুরো লিংক বা শুধু ভিডিও ID দিন।</p>
    </div>

    <div x-show="type === 'upload'" x-cloak>
        <label class="form-label" for="video_file">ভিডিও ফাইল</label>
        @if(! empty($video) && $video->getFirstMedia('video'))
            <p class="mb-2 text-xs text-gray-500">বর্তমান ফাইল আপলোড করা আছে। নতুন ফাইল দিলে প্রতিস্থাপিত হবে।</p>
        @endif
        <input id="video_file" name="video_file" type="file" accept="video/mp4,video/quicktime,video/webm"
               class="form-input file:mr-3 file:rounded-md file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-brand-700">
        <p class="mt-1 text-xs text-gray-400">MP4 / MOV / WEBM, সর্বোচ্চ ৫০ MB।</p>
    </div>

    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
        <input type="checkbox" name="is_published" value="1" class="rounded border-gray-300 text-brand-600 focus:ring-brand-500"
            @checked(old('is_published', $video->is_published ?? true))>
        প্রকাশ করুন
    </label>
    <div class="flex gap-3">
        <button type="submit" class="btn-primary">সংরক্ষণ করুন</button>
        <a href="{{ route('admin.videos.index') }}" class="btn-outline">বাতিল</a>
    </div>
</div>
