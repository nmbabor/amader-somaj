<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Donation;
use App\Models\Member;
use App\Models\Post;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedAdmin();
        $this->seedSettings();
        $this->seedCategories();
        $this->seedPosts();
        $this->seedTeam();
        $this->seedMembers();
        $this->seedDonations();
        $this->seedVideos();
    }

    private function seedAdmin(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@amadersomaj.org'],
            [
                'name' => 'প্রশাসক',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ],
        );
    }

    private function seedSettings(): void
    {
        $settings = [
            'site_name' => 'আমাদের সমাজ',
            'site_tagline' => '৭নং ধর্মপুর ইউনিয়ন',
            'site_description' => 'আমাদের সমাজ — ৭নং ধর্মপুর ইউনিয়নের একটি অরাজনৈতিক সামাজিক সংগঠন। গণগ্রন্থাগার, শিক্ষা সহায়তা, সমাজ উন্নয়ন ও সচেতনতামূলক কার্যক্রমে নিবেদিত।',
            'founded_year' => '2026',
            'hero_title' => 'আমরা গড়ি আলোকিত সমাজ',
            'hero_subtitle' => 'একটি গণগ্রন্থাগার দিয়ে যাত্রা শুরু। আমাদের লক্ষ্য — ইউনিয়নের উন্নয়ন, শিক্ষার্থী ও মানুষের পাশে দাঁড়ানো, সামাজিক সচেতনতা এবং সম্মিলিত উদ্যোগে একটি সুন্দর আগামী।',
            'about_history' => "আমাদের সমাজ যাত্রা শুরু করে ৭নং ধর্মপুর ইউনিয়নে একটি ছোট্ট গণগ্রন্থাগার দিয়ে। উদ্দেশ্য ছিল সহজ — গ্রামের শিক্ষার্থী ও সাধারণ মানুষের হাতে বই তুলে দেওয়া, জ্ঞানের আলো ছড়িয়ে দেওয়া।\n\nধীরে ধীরে এই উদ্যোগ পরিণত হয় একটি সামাজিক আন্দোলনে। শিক্ষা সহায়তা, স্বাস্থ্য সচেতনতা, পরিবেশ রক্ষা ও দুঃস্থদের পাশে দাঁড়ানো — সবকিছুতেই আজ আমরা সক্রিয়। স্থানীয় তরুণ-তরুণীদের স্বেচ্ছাশ্রম আর এলাকাবাসীর ভালোবাসাই আমাদের শক্তি।",
            'mission' => 'শিক্ষা, সেবা ও সচেতনতার মাধ্যমে ইউনিয়নের প্রতিটি মানুষের জীবনমান উন্নয়ন এবং একটি আত্মনির্ভরশীল, সুশিক্ষিত ও মানবিক সমাজ গড়ে তোলা।',
            'vision' => 'এমন একটি সমাজ যেখানে প্রতিটি শিশু শিক্ষার আলো পাবে, কোনো মানুষ অভাবে অসহায় থাকবে না এবং সবাই মিলেমিশে একটি সুন্দর, সুস্থ ও সচেতন জনপদ গড়ে তুলবে।',
            'contact_address' => '৭নং ধর্মপুর ইউনিয়ন পরিষদ সংলগ্ন, ধর্মপুর, বাংলাদেশ',
            'contact_phone' => '০১৩০৪-২৩৩১৭২',
            'contact_email' => 'info@amadersomaj.org',
            'whatsapp_number' => '8801304233172',
            'bkash_number' => '০১৩০৪-২৩৩১৭২',
            'nagad_number' => '০১৩০৪-২৩৩১৭২',
            'bank_info' => "ব্যাংক: ইসলামী ব্যাংক বাংলাদেশ\nহিসাব নাম: আমাদের সমাজ\nহিসাব নম্বর: ২০৫০১২৩৪৫৬৭৮৯০",
            'facebook_url' => 'https://facebook.com/AmaderSomajFoundation',
            'youtube_url' => 'https://youtube.com/@AmaderSomajFoundation',
            'footer_about' => 'একটি গণগ্রন্থাগার দিয়ে শুরু হওয়া আমাদের এই সংগঠনের লক্ষ্য ইউনিয়নের উন্নয়ন, শিক্ষার্থী ও মানুষের পাশে দাঁড়ানো এবং সামাজিক সচেতনতা গড়ে তোলা।',
            'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d562.8843735113956!2d91.10700741804287!3d22.749795797608197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3754aee52424d64d%3A0x80e5383267667bcf!2sVatirtek%20Chowrasta%20Bazar!5e0!3m2!1sen!2sbd!4v1781604815457!5m2!1sen!2sbd',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'general']);
        }
    }

    private function seedCategories(): void
    {
        $postCats = ['সমাজসেবা', 'শিক্ষা', 'স্বাস্থ্য', 'পরিবেশ', 'সংস্কৃতি'];
        foreach ($postCats as $i => $name) {
            Category::firstOrCreate(['slug' => Str::slug($name) ?: 'cat-post-'.$i], ['name' => $name, 'type' => 'post']);
        }

        $photoCats = ['অনুষ্ঠান', 'গ্রন্থাগার', 'শিক্ষা কার্যক্রম', 'ত্রাণ বিতরণ'];
        foreach ($photoCats as $i => $name) {
            Category::firstOrCreate(['slug' => (Str::slug($name) ?: 'cat-photo-'.$i).'-photo'], ['name' => $name, 'type' => 'photo']);
        }
    }

    private function seedPosts(): void
    {
        if (Post::count() > 0) {
            return;
        }

        $admin = User::where('is_admin', true)->first();
        $cats = Category::forPosts()->get();

        $samples = [
            ['শীতবস্ত্র বিতরণ কর্মসূচি সম্পন্ন', 'এই শীতে অসহায় ও দুঃস্থ পরিবারের মাঝে শীতবস্ত্র বিতরণ করা হয়েছে।', "গত শুক্রবার আমাদের সমাজের উদ্যোগে ৭নং ধর্মপুর ইউনিয়নের বিভিন্ন গ্রামে শীতার্ত মানুষের মাঝে কম্বল ও শীতবস্ত্র বিতরণ করা হয়।\n\nমোট ২০০টি পরিবারকে এই সহায়তা প্রদান করা হয়েছে। সংগঠনের সদস্য ও স্থানীয় স্বেচ্ছাসেবকরা এই কর্মসূচিতে অংশগ্রহণ করেন।\n\n## সকলের সহযোগিতায়\n\nএলাকাবাসী ও দাতাদের আন্তরিক সহযোগিতায় এই কর্মসূচি সফলভাবে সম্পন্ন হয়েছে। আমরা সকলের প্রতি কৃতজ্ঞ।"],
            ['বিনামূল্যে চিকিৎসা ক্যাম্প আয়োজন', 'গ্রামের মানুষের জন্য বিনামূল্যে স্বাস্থ্য পরীক্ষা ও ওষুধ বিতরণ।', "আমাদের সমাজের আয়োজনে একটি বিনামূল্যে চিকিৎসা ক্যাম্প অনুষ্ঠিত হয়। অভিজ্ঞ চিকিৎসকগণ রোগীদের বিনামূল্যে পরামর্শ ও ওষুধ প্রদান করেন।\n\nপ্রায় ৩৫০ জন মানুষ এই ক্যাম্প থেকে সেবা গ্রহণ করেন। রক্তচাপ, ডায়াবেটিস ও সাধারণ রোগের চিকিৎসা দেওয়া হয়।"],
            ['গণগ্রন্থাগারে নতুন বই সংযোজন', 'আমাদের পাঠাগারে যুক্ত হলো পাঁচ শতাধিক নতুন বই।', "শিক্ষার্থীদের চাহিদার কথা বিবেচনা করে আমাদের গণগ্রন্থাগারে নতুন করে ৫০০টিরও বেশি বই সংযোজন করা হয়েছে।\n\nএর মধ্যে রয়েছে পাঠ্যবই, সহায়ক গ্রন্থ, গল্প-উপন্যাস ও প্রতিযোগিতামূলক পরীক্ষার বই। শিক্ষার্থীরা বিনামূল্যে এসব বই পড়তে ও ধার নিতে পারবে।"],
            ['বৃক্ষরোপণ অভিযান ২০২৪', 'পরিবেশ রক্ষায় ইউনিয়নজুড়ে বৃক্ষরোপণ কর্মসূচি।', "পরিবেশ সুরক্ষা ও সবুজায়নের লক্ষ্যে আমাদের সমাজ একটি বৃক্ষরোপণ অভিযান পরিচালনা করে। ইউনিয়নের বিভিন্ন রাস্তা, স্কুল ও মসজিদ প্রাঙ্গণে এক হাজারেরও বেশি গাছের চারা রোপণ করা হয়।\n\nশিক্ষার্থী ও স্বেচ্ছাসেবকরা উৎসাহের সাথে এই কর্মসূচিতে অংশ নেন।"],
            ['মেধাবী শিক্ষার্থীদের বৃত্তি প্রদান', 'অসচ্ছল মেধাবী শিক্ষার্থীদের শিক্ষা বৃত্তি দেওয়া হয়েছে।', "আমাদের সমাজের পক্ষ থেকে এ বছর ২৫ জন অসচ্ছল কিন্তু মেধাবী শিক্ষার্থীকে শিক্ষা বৃত্তি প্রদান করা হয়েছে।\n\nএই বৃত্তি তাদের পড়াশোনা চালিয়ে যেতে সহায়তা করবে। প্রতিটি শিক্ষার্থীকে শিক্ষা উপকরণসহ আর্থিক সহায়তা দেওয়া হয়।"],
            ['মাদকবিরোধী সচেতনতা সমাবেশ', 'তরুণ সমাজকে মাদকের কুফল সম্পর্কে সচেতন করতে সমাবেশ।', "মাদকের ভয়াবহ ছোবল থেকে তরুণ প্রজন্মকে রক্ষা করতে আমাদের সমাজ একটি সচেতনতা সমাবেশের আয়োজন করে।\n\nসমাবেশে বক্তারা মাদকের কুফল ও এর বিরুদ্ধে সামাজিক প্রতিরোধ গড়ে তোলার আহ্বান জানান। শতাধিক যুবক-যুবতী এতে অংশগ্রহণ করেন।"],
        ];

        foreach ($samples as $i => [$title, $excerpt, $body]) {
            Post::create([
                'title' => $title,
                'excerpt' => $excerpt,
                'body' => $body,
                'category_id' => $cats[$i % $cats->count()]->id ?? null,
                'user_id' => $admin?->id,
                'is_published' => true,
                'published_at' => now()->subDays($i * 4),
                'views' => rand(20, 300),
            ]);
        }
    }

    private function seedTeam(): void
    {
        if (TeamMember::count() > 0) {
            return;
        }

        $team = [
            ['মোঃ আব্দুল করিম', 'সভাপতি', 0],
            ['মোছাঃ রহিমা খাতুন', 'সাধারণ সম্পাদক', 1],
            ['মোঃ জসিম উদ্দিন', 'কোষাধ্যক্ষ', 2],
            ['মোঃ সাইফুল ইসলাম', 'প্রচার সম্পাদক', 3],
        ];

        foreach ($team as [$name, $designation, $order]) {
            TeamMember::create([
                'name' => $name,
                'designation' => $designation,
                'bio' => 'সংগঠনের একনিষ্ঠ কর্মী ও সমাজসেবায় নিবেদিতপ্রাণ।',
                'sort_order' => $order,
                'is_active' => true,
            ]);
        }
    }

    private function seedMembers(): void
    {
        if (Member::count() > 0) {
            return;
        }

        $members = [
            ['মোঃ রফিকুল ইসলাম', '01711000001', 'lifetime', 'approved'],
            ['মোছাঃ নাসরিন আক্তার', '01711000002', 'general', 'approved'],
            ['মোঃ হাবিবুর রহমান', '01711000003', 'general', 'pending'],
            ['মোঃ কামাল হোসেন', '01711000004', 'donor', 'pending'],
        ];

        foreach ($members as $i => [$name, $phone, $tier, $status]) {
            Member::create([
                'name' => $name,
                'phone' => $phone,
                'tier' => $tier,
                'status' => $status,
                'occupation' => 'ব্যবসায়ী',
                'address' => 'ধর্মপুর, ৭নং ইউনিয়ন',
                'membership_no' => $status === 'approved' ? 'AS-'.str_pad((string) ($i + 1), 5, '0', STR_PAD_LEFT) : null,
                'joined_at' => $status === 'approved' ? now()->subMonths($i + 1) : null,
            ]);
        }
    }

    private function seedDonations(): void
    {
        if (Donation::count() > 0) {
            return;
        }

        $donations = [
            ['আব্দুল্লাহ আল মামুন', 5000, 'bkash', 'verified'],
            ['সুমাইয়া ইসলাম', 2000, 'nagad', 'verified'],
            ['নাম প্রকাশে অনিচ্ছুক', 10000, 'bank', 'verified'],
            ['রাকিব হাসান', 1000, 'bkash', 'pending'],
        ];

        foreach ($donations as $i => [$name, $amount, $method, $status]) {
            Donation::create([
                'donor_name' => $name,
                'amount' => $amount,
                'method' => $method,
                'status' => $status,
                'transaction_id' => strtoupper($method).rand(100000, 999999),
                'donated_at' => now()->subDays($i * 3),
            ]);
        }
    }

    private function seedVideos(): void
    {
        if (Video::count() > 0) {
            return;
        }

        $videos = [
            ['আমাদের সমাজের পরিচিতি', 'dQw4w9WgXcQ'],
            ['শীতবস্ত্র বিতরণ কর্মসূচি', 'M7lc1UVf-VE'],
            ['গণগ্রন্থাগার উদ্বোধন', 'aqz-KE-bpKQ'],
        ];

        foreach ($videos as $i => [$title, $ytId]) {
            Video::create([
                'title' => $title,
                'description' => 'আমাদের সমাজের কার্যক্রমের ভিডিও।',
                'type' => 'youtube',
                'youtube_id' => $ytId,
                'is_published' => true,
                'sort_order' => $i,
            ]);
        }
    }
}
