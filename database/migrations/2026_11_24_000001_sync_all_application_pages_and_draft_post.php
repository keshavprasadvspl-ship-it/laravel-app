<?php

use App\Models\Page;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Hide auto-draft post from catalog
        Product::where('id', 1237)
            ->orWhere('title', 'like', '%auto-draft%')
            ->update(['status' => 'draft']);

        // 2. Sync application pages from WP snapshots with clean internal links
        $pages = [
            'food-drug-cosmetics' => database_path('data/live_app_food-drug-cosmetics.json'),
            'coating' => database_path('data/live_app_coating.json'),
            'paint' => database_path('data/live_app_paint.json'),
            'rubber' => database_path('data/live_app_rubber.json'),
            'intermediates' => database_path('data/live_app_intermediates.json'),
            'pigment-intermediates' => database_path('data/live_app_pigment-intermediates.json'),
            'wax' => database_path('data/live_app_wax.json'),
        ];

        foreach ($pages as $slug => $file) {
            if (file_exists($file)) {
                $data = json_decode(file_get_contents($file), true);
                $content = $data['content']['rendered'] ?? '';

                // Clean product URLs to relative routes
                $content = preg_replace('#https?://(?:www\.)?sdinternational\.com/product/#i', '/', $content);
                $content = preg_replace('#https?://(?:www\.)?sdinternational\.com/#i', '/', $content);

                // Remove trailing slashes from internal hrefs: href="/some-product/" -> href="/some-product"
                $content = preg_replace_callback('/href="\/([a-zA-Z0-9_\-]+)\/"/i', function ($m) {
                    return 'href="/' . $m[1] . '"';
                }, $content);

                $page = Page::firstOrNew(['slug' => $slug]);
                if (!$page->exists) {
                    $page->title = ucwords(str_replace('-', ' ', $slug));
                    $page->status = 'publish';
                }
                $page->content = $content;
                $page->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
    }
};
