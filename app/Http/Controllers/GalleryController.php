<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Video;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function photos(Request $request)
    {
        $categories = Category::forPhotos()->withCount(['photos' => fn ($q) => $q->where('is_published', true)])->get();

        $photos = Photo::with('media', 'category')
            ->where('is_published', true)
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
            })
            ->orderBy('sort_order')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('pages.gallery.photos', compact('photos', 'categories'));
    }

    public function videos()
    {
        $videos = Video::with('media')
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->latest()
            ->paginate(9);

        return view('pages.gallery.videos', compact('videos'));
    }
}
