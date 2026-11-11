<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
use App\Models\Post;
use App\Models\SeoMeta;
use App\Models\Redirect;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $dataPath = database_path('data');
        if (!File::isDirectory($dataPath)) {
            $this->command->error("Data directory {$dataPath} not found!");
            return;
        }

        // Clean tables
        DB::statement('DELETE FROM category_product');
        DB::statement('DELETE FROM seo_metas');
        DB::statement('DELETE FROM products');
        DB::statement('DELETE FROM categories');
        DB::statement('DELETE FROM pages');
        DB::statement('DELETE FROM posts');
        DB::statement('DELETE FROM redirects');

        $this->command->info("Seeding Categories...");
        $categoriesFile = $dataPath . '/categories.json';
        $categoryMap = []; // wp_term_taxonomy_id => category_id

        if (File::exists($categoriesFile)) {
            $categories = json_decode(File::get($categoriesFile), true);
            foreach ($categories as $cat) {
                if (empty($cat['name'])) continue;
                $slug = $cat['slug'] ?: Str::slug($cat['name']);
                if (Category::where('slug', $slug)->exists()) {
                    $slug = $slug . '-' . $cat['term_id'];
                }
                
                $category = Category::create([
                    'wp_term_id' => $cat['term_id'],
                    'wp_term_taxonomy_id' => $cat['term_taxonomy_id'],
                    'name' => html_entity_decode($cat['name']),
                    'slug' => $slug,
                    'parent_id' => $cat['parent_id'],
                    'description' => $cat['description'] ?? null,
                ]);

                $categoryMap[$cat['term_taxonomy_id']] = $category->id;

                SeoMeta::create([
                    'seoable_type' => Category::class,
                    'seoable_id' => $category->id,
                    'meta_title' => $category->name . ' Manufacturer, Exporter, Supplier in India | SD International',
                    'meta_description' => 'SD International is leading manufacturer, supplier and exporter of ' . $category->name . ' in India. High quality and purity guaranteed.',
                    'canonical_url' => url('/' . $category->slug),
                    'robots' => 'index,follow',
                ]);
            }
        }

        $this->command->info("Seeding Products...");
        $productsFile = $dataPath . '/products.json';
        if (File::exists($productsFile)) {
            $products = json_decode(File::get($productsFile), true);
            foreach ($products as $p) {
                $slug = $p['slug'] ?: Str::slug($p['title']);
                if (Product::where('slug', $slug)->exists()) {
                    $slug = $slug . '-' . $p['id'];
                }

                $product = Product::create([
                    'wp_id' => $p['id'],
                    'title' => html_entity_decode($p['title']),
                    'slug' => $slug,
                    'brand' => $p['brand'] ?? 'S D International',
                    'cas_number' => $p['cas_number'] ?? null,
                    'ci_number' => $p['ci_number'] ?? null,
                    'relative_name' => $p['relative_name'] ?? null,
                    'molecular_formula' => $p['molecular_formula'] ?? null,
                    'molecular_weight' => $p['molecular_weight'] ?? null,
                    'physical_appearance' => $p['physical_appearance'] ?? null,
                    'packaging' => $p['packaging'] ?? null,
                    'short_description' => $p['excerpt'] ?? null,
                    'content' => $p['content'] ?? null,
                    'excerpt' => $p['excerpt'] ?? null,
                    'image_url' => $p['image_url'] ?? null,
                    'attributes_json' => $p['attributes'] ?? null,
                    'status' => 'publish',
                ]);

                if (!empty($p['category_ids'])) {
                    $catIdsToAttach = [];
                    foreach ($p['category_ids'] as $ttid) {
                        if (isset($categoryMap[$ttid])) {
                            $catIdsToAttach[] = $categoryMap[$ttid];
                        }
                    }
                    if (!empty($catIdsToAttach)) {
                        $product->categories()->syncWithoutDetaching($catIdsToAttach);
                    }
                }

                $seo = $p['seo'] ?? [];
                SeoMeta::create([
                    'seoable_type' => Product::class,
                    'seoable_id' => $product->id,
                    'meta_title' => $seo['meta_title'] ?? ($product->title . ' | SD International'),
                    'meta_description' => $seo['meta_description'] ?? $product->short_description,
                    'focus_keyword' => $seo['focus_keyword'] ?? '',
                    'canonical_url' => url('/' . $product->slug),
                    'robots' => 'index,follow,max-snippet:-1,max-video-preview:-1,max-image-preview:large',
                    'og_image' => $product->image_url,
                ]);
            }
        }

        $this->command->info("Seeding Pages...");
        $pagesFile = $dataPath . '/pages.json';
        if (File::exists($pagesFile)) {
            $pages = json_decode(File::get($pagesFile), true);
            foreach ($pages as $pg) {
                if (empty($pg['title'])) continue;
                $slug = $pg['slug'] ?: Str::slug($pg['title']);
                if (Page::where('slug', $slug)->exists()) {
                    $slug = $slug . '-' . $pg['id'];
                }

                $page = Page::create([
                    'wp_id' => $pg['id'],
                    'title' => html_entity_decode($pg['title']),
                    'slug' => $slug,
                    'content' => $pg['content'] ?? null,
                ]);

                $seo = $pg['seo'] ?? [];
                SeoMeta::create([
                    'seoable_type' => Page::class,
                    'seoable_id' => $page->id,
                    'meta_title' => $seo['meta_title'] ?? ($page->title . ' | SD International'),
                    'meta_description' => $seo['meta_description'] ?? ('Explore ' . $page->title . ' at SD International.'),
                    'focus_keyword' => $seo['focus_keyword'] ?? '',
                    'canonical_url' => url('/' . $page->slug),
                    'robots' => 'index,follow',
                ]);
            }
        }

        $this->command->info("Seeding Articles...");
        $articlesFile = $dataPath . '/articles.json';
        if (File::exists($articlesFile)) {
            $articles = json_decode(File::get($articlesFile), true);
            foreach ($articles as $art) {
                if (empty($art['title'])) continue;
                $slug = $art['slug'] ?: Str::slug($art['title']);
                if (Post::where('slug', $slug)->exists()) {
                    $slug = $slug . '-' . $art['id'];
                }

                $post = Post::create([
                    'wp_id' => $art['id'],
                    'title' => html_entity_decode($art['title']),
                    'slug' => $slug,
                    'excerpt' => $art['excerpt'] ?? null,
                    'content' => $art['content'] ?? null,
                    'image_url' => $art['image_url'] ?? null,
                ]);

                $seo = $art['seo'] ?? [];
                SeoMeta::create([
                    'seoable_type' => Post::class,
                    'seoable_id' => $post->id,
                    'meta_title' => $seo['meta_title'] ?? ($post->title . ' | SD International Blogs'),
                    'meta_description' => $seo['meta_description'] ?? $post->excerpt,
                    'focus_keyword' => $seo['focus_keyword'] ?? '',
                    'canonical_url' => url('/blogs/' . $post->slug),
                    'robots' => 'index,follow',
                    'og_image' => $post->image_url,
                ]);
            }
        }

        $this->command->info("Seeding Redirects...");
        $redirectsFile = $dataPath . '/redirects.json';
        if (File::exists($redirectsFile)) {
            $redirects = json_decode(File::get($redirectsFile), true);
            foreach ($redirects as $r) {
                $sources = $r['sources'] ?? '';
                $pattern = '';
                if (str_starts_with($sources, 'a:')) {
                    if (preg_match('/s:7:"pattern";s:\d+:"([^"]+)"/', $sources, $m)) {
                        $pattern = $m[1];
                    }
                } else {
                    $pattern = $sources;
                }

                if ($pattern && !empty($r['url_to'])) {
                    $dest = str_replace(['https://moccasin-worm-620280.hostingersite.com', 'http://moccasin-worm-620280.hostingersite.com'], '', $r['url_to']);
                    Redirect::create([
                        'source_pattern' => trim($pattern, '/'),
                        'destination_url' => $dest,
                        'status_code' => $r['code'] ?: 301,
                    ]);
                }
            }
        }

        $this->call(LiveBlogSeeder::class);
        $this->command->info("All data successfully seeded!");
    }
}
