<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $searchHosts = [
            'https://moccasin-worm-620280.hostingersite.com/',
            'http://moccasin-worm-620280.hostingersite.com/',
            'https://moccasin-worm-620280.hostingersite.com',
            'http://moccasin-worm-620280.hostingersite.com',
        ];

        // 1. Update posts
        if (DB::getSchemaBuilder()->hasTable('posts')) {
            $posts = DB::table('posts')->where('content', 'LIKE', '%hostingersite.com%')->get();
            foreach ($posts as $post) {
                $cleaned = str_replace($searchHosts, ['/', '/', '/', '/'], $post->content);
                DB::table('posts')->where('id', $post->id)->update(['content' => $cleaned]);
            }
        }

        // 2. Update products
        if (DB::getSchemaBuilder()->hasTable('products')) {
            $products = DB::table('products')->where('content', 'LIKE', '%hostingersite.com%')->get();
            foreach ($products as $prod) {
                $cleaned = str_replace($searchHosts, ['/', '/', '/', '/'], $prod->content);
                DB::table('products')->where('id', $prod->id)->update(['content' => $cleaned]);
            }
        }

        // 3. Update pages
        if (DB::getSchemaBuilder()->hasTable('pages')) {
            $pages = DB::table('pages')->where('content', 'LIKE', '%hostingersite.com%')->get();
            foreach ($pages as $pg) {
                $cleaned = str_replace($searchHosts, ['/', '/', '/', '/'], $pg->content);
                DB::table('pages')->where('id', $pg->id)->update(['content' => $cleaned]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Irreversible clean-up of temporary staging domain references
    }
};
