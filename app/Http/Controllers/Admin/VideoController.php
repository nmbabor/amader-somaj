<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('media')->latest()->paginate(15);

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['youtube_id'] = $this->extractYoutubeId($request->input('youtube_id'));

        $video = Video::create($data);

        if ($request->hasFile('video_file')) {
            $video->addMediaFromRequest('video_file')->toMediaCollection('video');
        }

        return redirect()->route('admin.videos.index')->with('success', 'ভিডিও যুক্ত হয়েছে।');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $this->validateData($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['youtube_id'] = $this->extractYoutubeId($request->input('youtube_id'));

        $video->update($data);

        if ($request->hasFile('video_file')) {
            $video->clearMediaCollection('video');
            $video->addMediaFromRequest('video_file')->toMediaCollection('video');
        }

        return redirect()->route('admin.videos.index')->with('success', 'ভিডিও হালনাগাদ হয়েছে।');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return back()->with('success', 'ভিডিও মুছে ফেলা হয়েছে।');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'type' => ['required', 'in:youtube,upload'],
            'youtube_id' => ['nullable', 'string', 'max:255'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime,video/webm', 'max:51200'],
            'is_published' => ['nullable', 'boolean'],
        ]);
    }

    /**
     * Accept either a raw YouTube ID or a full URL and return the 11-char ID.
     */
    private function extractYoutubeId(?string $value): ?string
    {
        if (! $value) {
            return null;
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $value, $m)) {
            return $m[1];
        }

        return Str::of($value)->trim()->limit(20, '')->value();
    }
}
