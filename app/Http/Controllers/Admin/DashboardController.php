<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Donation;
use App\Models\Member;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Video;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'photos' => Photo::count(),
            'videos' => Video::count(),
            'members' => Member::count(),
            'members_pending' => Member::where('status', 'pending')->count(),
            'donations_total' => (int) Donation::verified()->sum('amount'),
            'donations_pending' => Donation::where('status', 'pending')->count(),
            'contacts_unread' => Contact::where('is_read', false)->count(),
        ];

        $recentMembers = Member::latest()->take(5)->get();
        $recentDonations = Donation::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMembers', 'recentDonations', 'recentContacts'));
    }
}
