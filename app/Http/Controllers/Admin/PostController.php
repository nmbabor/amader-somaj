<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::forPosts()->orderBy('name')->get();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['user_id'] = $request->user()->id;
        $data['featured_image'] = $this->handleImage($request);

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'কার্যক্রম সফলভাবে যুক্ত হয়েছে।');
    }

    public function edit(Post $post)
    {
        $categories = Category::forPosts()->orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $this->handleImage($request);
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'কার্যক্রম হালনাগাদ হয়েছে।');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $post->delete();

        return back()->with('success', 'কার্যক্রম মুছে ফেলা হয়েছে।');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'featured_image' => ['nullable', 'image', 'max:4096'],
        ]) + ['is_published' => $request->boolean('is_published')];
    }

    private function handleImage(Request $request): ?string
    {
        if ($request->hasFile('featured_image')) {
            return $request->file('featured_image')->store('posts', 'public');
        }

        return null;
    }
}
