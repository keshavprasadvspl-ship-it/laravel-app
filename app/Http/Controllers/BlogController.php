<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\SeoHelper;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(12);

        $seo = [
            'site_name' => 'S D International',
            'title' => 'Blogs & Industry Insights | SD International',
            'description' => 'Read latest technical guides, industrial applications, and news on Vat Dyes, Solvent Dyes, Pigments and Chemical Intermediates by SD International.',
            'canonical' => url('/blogs'),
            'og_image' => 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            'og_type' => 'website',
            'robots' => 'index,follow',
            'url' => url()->current(),
        ];

        $breadcrumbs = [
            'Home' => url('/'),
            'Blogs' => url('/blogs'),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        return view('blogs.index', compact('posts', 'seo', 'breadcrumbs', 'breadcrumbSchema'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $seo = SeoHelper::generateTags($post, [
            'title' => "{$post->title} | SD International",
            'description' => $post->excerpt ?: substr(strip_tags($post->content), 0, 160),
            'canonical' => url('/blogs/' . $post->slug),
            'og_image' => $post->image_url ?: 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            'og_type' => 'article',
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            'Blogs' => url('/blogs'),
            $post->title => url('/blogs/' . $post->slug),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        $recentPosts = Post::where('id', '!=', $post->id)->latest()->take(5)->get();

        return view('blogs.show', compact('post', 'seo', 'breadcrumbs', 'breadcrumbSchema', 'recentPosts'));
    }
}
