<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Editable settings, grouped for the admin form.
     * key => [label, type]
     */
    public static function schema(): array
    {
        return [
            'সাধারণ তথ্য' => [
                'site_name' => ['সাইটের নাম', 'text'],
                'site_tagline' => ['ট্যাগলাইন', 'text'],
                'site_description' => ['সাইটের বর্ণনা (SEO)', 'textarea'],
                'founded_year' => ['প্রতিষ্ঠার বছর', 'number'],
            ],
            'হোম হিরো' => [
                'hero_title' => ['হিরো শিরোনাম', 'text'],
                'hero_subtitle' => ['হিরো বর্ণনা', 'textarea'],
                'hero_image' => ['হিরো ছবি', 'image'],
            ],
            'আমাদের সম্পর্কে' => [
                'about_history' => ['ইতিহাস', 'textarea'],
                'mission' => ['লক্ষ্য (Mission)', 'textarea'],
                'vision' => ['স্বপ্ন (Vision)', 'textarea'],
                'about_image' => ['ছবি', 'image'],
            ],
            'যোগাযোগ' => [
                'contact_address' => ['ঠিকানা', 'text'],
                'contact_phone' => ['ফোন', 'text'],
                'contact_email' => ['ইমেইল', 'text'],
                'whatsapp_number' => ['WhatsApp নম্বর (8801...)', 'text'],
                'map_embed' => ['Google Maps embed URL', 'textarea'],
            ],
            'পেমেন্ট' => [
                'bkash_number' => ['বিকাশ নম্বর', 'text'],
                'nagad_number' => ['নগদ নম্বর', 'text'],
                'bank_info' => ['ব্যাংক তথ্য', 'textarea'],
            ],
            'সোশ্যাল ও ফুটার' => [
                'facebook_url' => ['Facebook URL', 'text'],
                'youtube_url' => ['YouTube URL', 'text'],
                'footer_about' => ['ফুটার বর্ণনা', 'textarea'],
            ],
        ];
    }

    public function edit()
    {
        $schema = static::schema();
        $values = Setting::all();

        return view('admin.settings.edit', compact('schema', 'values'));
    }

    public function update(Request $request)
    {
        foreach (static::schema() as $fields) {
            foreach ($fields as $key => [$label, $type]) {
                if ($type === 'image') {
                    if ($request->hasFile($key)) {
                        $request->validate([$key => ['image', 'max:4096']]);
                        $old = Setting::get($key);
                        if ($old) {
                            Storage::disk('public')->delete($old);
                        }
                        $path = $request->file($key)->store('settings', 'public');
                        Setting::set($key, $path, 'general', 'image');
                    }
                    continue;
                }

                Setting::set($key, $request->input($key), 'general', $type);
            }
        }

        return back()->with('success', 'সেটিংস সংরক্ষণ করা হয়েছে।');
    }
}
