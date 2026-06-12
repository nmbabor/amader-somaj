<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Member;
use App\Models\Photo;
use App\Models\Post;
use App\Models\TeamMember;

class PageController extends Controller
{
    public function home()
    {
        $recentPosts = Post::published()
            ->with('category')
            ->latest('published_at')
            ->take(3)
            ->get();

        $photos = Photo::where('is_published', true)
            ->latest()
            ->take(8)
            ->get();

        $stats = [
            'members' => Member::where('status', 'approved')->count(),
            'posts' => Post::published()->count(),
            'donations' => (int) Donation::verified()->sum('amount'),
            'years' => max(1, now()->year - (int) setting('founded_year', 2018)),
        ];

        return view('pages.home', compact('recentPosts', 'photos', 'stats'));
    }

    public function about()
    {
        $team = TeamMember::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.about', compact('team'));
    }
}