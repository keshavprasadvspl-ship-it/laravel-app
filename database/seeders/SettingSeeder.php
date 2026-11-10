<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'company_name' => ['SD International', 'general'],
            'company_tagline' => ['Leading Manufacturer & Global Exporter of Dyes, Pigments & Food Colours', 'general'],
            'phone' => ['+91 99206 69561', 'contact'],
            'phone_alt' => ['+91 22 2854 4455', 'contact'],
            'whatsapp' => ['+919920669561', 'contact'],
            'email' => ['info@sdinternational.com', 'contact'],
            'export_email' => ['sales@sdinternational.com', 'contact'],
            'corporate_address' => ['101, Express Zone, Western Express Highway, Malad (East), Mumbai - 400097, Maharashtra, India', 'contact'],
            'factory_address' => ['Plot No. C-1/25, GIDC Industrial Estate, Ankleshwar, Gujarat - 393002, India', 'contact'],
            'working_hours' => ['Mon - Sat: 9:30 AM - 6:30 PM (IST)', 'contact'],
            'meta_title' => ['SD International | Dyes, Pigments, Food Colours Manufacturer & Exporter in India', 'seo'],
            'meta_description' => ['SD International is premier manufacturer, supplier & global exporter of Vat Dyes, Basic Dyes, Acid Dyes, Solvent Dyes, Pigments, and Food Colours in Mumbai, India.', 'seo'],
            'linkedin_url' => ['https://www.linkedin.com/company/sd-international/', 'social'],
            'facebook_url' => ['https://www.facebook.com/sdinternationaldyes/', 'social'],
            'twitter_url' => ['https://twitter.com/sdinternational', 'social'],
            'export_countries_count' => ['45+', 'stats'],
            'annual_capacity_mt' => ['12,000 MT', 'stats'],
        ];

        foreach ($defaults as $key => [$value, $group]) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        }
    }
}

