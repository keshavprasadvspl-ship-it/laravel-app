<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $content = view('sitemaps.index')->render();
        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function products()
    {
        $products = Product::where('status', 'publish')->select('slug', 'updated_at')->get();
        $content = view('sitemaps.products', compact('products'))->render();
        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $categories = Category::select('slug', 'updated_at')->get();
        $content = view('sitemaps.categories', compact('categories'))->render();
        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function pages()
    {
        $pages = Page::select('slug', 'updated_at')->get();
        $content = view('sitemaps.pages', compact('pages'))->render();
        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function posts()
    {
        $posts = Post::select('slug', 'updated_at')->get();
        $content = view('sitemaps.posts', compact('posts'))->render();
        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function robots()
    {
        $text = "User-agent: *\n";
        $text .= "Allow: /\n\n";
        $text .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return response($text, 200)->header('Content-Type', 'text/plain');
    }
}
