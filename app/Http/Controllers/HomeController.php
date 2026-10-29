<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
use App\Models\Post;
use App\Services\SeoHelper;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'home')->first();

        $seo = SeoHelper::generateTags($page, [
            'title' => 'SD International - Vat dyes manufacturer in india, solvent dyes manufacturer in india, Disperse dyes, food colours, organic pigments, Naphthols, fast bases & salts manufacturer in india',
            'description' => 'Vat dyes manufacturer in india, solvent dyes manufacturer in india, Disperse dyes, food colours, organic pigments, Naphthols, fast bases & salts manufacturer in india',
            'canonical' => url('/'),
        ]);

        $featuredCategories = Category::whereIn('slug', [
            'vat-dyes', 'basic-dyes', 'disperse-dyes', 'solvent-dyes',
            'reactive-dyes', 'acid-dyes', 'organic-pigments', 'f-d-c-colours',
            'direct-dyes', 'fast-colour-bases', 'fast-colour-salts', 'naphthols'
        ])->get();

        if ($featuredCategories->isEmpty()) {
            $featuredCategories = Category::where('parent_id', 0)->take(12)->get();
        }

        $featuredProducts = Product::where('status', 'publish')
            ->whereNotNull('image_url')
            ->where('image_url', '!=', '')
            ->take(8)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::where('status', 'publish')->take(8)->get();
        }

        $recentPosts = Post::latest()->take(3)->get();

        $schema = SeoHelper::organizationSchema();

        return view('pages.home', compact('page', 'seo', 'featuredCategories', 'featuredProducts', 'recentPosts', 'schema'));
    }
}
