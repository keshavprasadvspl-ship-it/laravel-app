<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $jsonPath = database_path('data/blog_full_contents.json');
        if (file_exists($jsonPath)) {
            $articles = json_decode(file_get_contents($jsonPath), true) ?: [];
            foreach ($articles as $slug => $data) {
                if (empty($data['content'])) {
                    continue;
                }
                DB::table('posts')
                    ->where('slug', $slug)
                    ->update([
                        'content' => $data['content'],
                        'excerpt' => $data['excerpt'] ?? Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($data['content']))), 175),
                        'updated_at' => now(),
                    ]);
            }
        }

        // Backfill missing excerpts for all older posts so blog archive cards on pages 2-8 show summaries
        $postsWithoutExcerpt = DB::table('posts')
            ->where(function ($q) {
                $q->whereNull('excerpt')->orWhere('excerpt', '');
            })
            ->get(['id', 'content']);

        foreach ($postsWithoutExcerpt as $post) {
            $plain = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($post->content ?? ''), ENT_QUOTES, 'UTF-8')));
            if ($plain !== '') {
                DB::table('posts')
                    ->where('id', $post->id)
                    ->update([
                        'excerpt' => Str::limit($plain, 175),
                    ]);
            }
        }
    }

    public function down(): void
    {
        // Data backfill migration — no destructive rollback needed
    }
};
