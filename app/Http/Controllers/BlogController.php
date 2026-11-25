<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Redirect;
use App\Services\SeoHelper;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

        $canonical = $posts->currentPage() > 1 
            ? url('/blogs/page/' . $posts->currentPage() . '/') 
            : url('/blogs/');

        $seo = [
            'site_name' => 'S D International',
            'title' => $posts->currentPage() > 1 
                ? 'Blogs & Industry Insights - Page ' . $posts->currentPage() . ' | SD International'
                : 'Blogs & Industry Insights | SD International',
            'description' => 'Read latest technical guides, industrial applications, and news on Vat Dyes, Solvent Dyes, Pigments and Chemical Intermediates by SD International.',
            'canonical' => $canonical,
            'og_image' => 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            'og_type' => 'website',
            'robots' => 'index,follow',
            'url' => url()->current(),
        ];

        $breadcrumbs = [
            'Home' => url('/'),
            'Blogs' => url('/blogs/'),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        return view('blogs.index', compact('posts', 'seo', 'breadcrumbs', 'breadcrumbSchema'));
    }

    public function show(string $slug, ?Request $request = null)
    {
        $request = $request ?: request();
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            // Check redirects for blogs/{slug}
            $cleanSlug = trim($slug, '/');
            $fullPath = trim($request->path(), '/');
            $redirect = Redirect::where('source_pattern', 'blogs/' . $cleanSlug)
                ->orWhere('source_pattern', '/' . $fullPath)
                ->orWhere('source_pattern', $fullPath)
                ->first();

            if ($redirect) {
                return redirect($redirect->destination_url, (int) $redirect->status_code);
            }

            return response()->view('errors.404', [
                'slug' => $slug,
            ], 404);
        }

        // Hydrate full content from synced snapshot if DB record still has truncated placeholder text
        $plainLen = strlen(trim(strip_tags($post->content ?? '')));
        if ($plainLen < 500) {
            $jsonPath = database_path('data/blog_full_contents.json');
            if (file_exists($jsonPath)) {
                $articles = json_decode(file_get_contents($jsonPath), true) ?: [];
                if (!empty($articles[$post->slug]['content'])) {
                    $post->content = $articles[$post->slug]['content'];
                }
            }
        }

        // Format content with proper paragraphs matching WordPress wpautop
        $post->content = wpautop($post->content ?? '');

        $seo = SeoHelper::generateTags($post, [
            'title' => "{$post->title} | SD International",
            'description' => $post->excerpt ?: substr(strip_tags($post->content), 0, 160),
            'canonical' => url('/blogs/' . $post->slug . '/'),
            'og_image' => $post->image_url ?: 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            'og_type' => 'article',
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            'Blogs' => url('/blogs/'),
            $post->title => url('/blogs/' . $post->slug . '/'),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        $recentPosts = Post::where('id', '!=', $post->id)->latest()->take(5)->get();

        return view('blogs.show', compact('post', 'seo', 'breadcrumbs', 'breadcrumbSchema', 'recentPosts'));
    }
}
