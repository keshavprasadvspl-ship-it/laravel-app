<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            // General
            'company_name' => 'general',
            'company_tagline' => 'general',
            // Contact
            'phone' => 'contact',
            'phone_alt' => 'contact',
            'whatsapp' => 'contact',
            'email' => 'contact',
            'export_email' => 'contact',
            'working_hours' => 'contact',
            'corporate_address' => 'contact',
            'factory_address' => 'contact',
            // SEO & Social
            'meta_title' => 'seo',
            'meta_description' => 'seo',
            'linkedin_url' => 'social',
            'facebook_url' => 'social',
            'twitter_url' => 'social',
            'google_analytics_id' => 'seo',
            // Stats
            'export_countries_count' => 'stats',
            'annual_capacity_mt' => 'stats',
        ];

        foreach ($fields as $key => $group) {
            $value = $request->input($key, '');
            Setting::set($key, $value, $group);
        }

        // Clear general settings cache
        Cache::flush();

        return back()->with('success', 'Website settings have been successfully updated!');
    }
}
