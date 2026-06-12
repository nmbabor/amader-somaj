<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::forPosts()->withCount(['posts' => fn ($q) => $q->published()])->get();

        $posts = Post::published()
            ->with('category')
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%'.$request->q.'%')
                      ->orWhere('body', 'like', '%'.$request->q.'%');
                });
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('pages.activities.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published, 404);

        $post->increment('views');

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->when($post->category_id, fn ($q) => $q->where('category_id', $post->category_id))
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.activities.show', compact('post', 'related'));
    }
}