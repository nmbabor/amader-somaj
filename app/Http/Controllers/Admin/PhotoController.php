<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::with('category', 'media')->latest()->paginate(18);

        return view('admin.photos.index', compact('photos'));
    }

    public function create()
    {
        $categories = Category::forPhotos()->orderBy('name')->get();

        return view('admin.photos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'caption' => ['nullable', 'string', 'max:1000'],
            'is_published' => ['nullable', 'boolean'],
            'image' => ['required', 'image', 'max:6144'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        $photo = Photo::create($data);
        $photo->addMediaFromRequest('image')->toMediaCollection('image');

        return redirect()->route('admin.photos.index')->with('success', 'ছবি যুক্ত হয়েছে।');
    }

    public function edit(Photo $photo)
    {
        $categories = Category::forPhotos()->orderBy('name')->get();

        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    public function update(Request $request, Photo $photo)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'caption' => ['nullable', 'string', 'max:1000'],
            'is_published' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:6144'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        $photo->update($data);

        if ($request->hasFile('image')) {
            $photo->clearMediaCollection('image');
            $photo->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return redirect()->route('admin.photos.index')->with('success', 'ছবি হালনাগাদ হয়েছে।');
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();

        return back()->with('success', 'ছবি মুছে ফেলা হয়েছে।');
    }
}
