<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
use Illuminate\Http\Request;

class FallbackController extends Controller
{
    public function resolve(string $slug, Request $request)
    {
        $cleanSlug = trim($slug, '/');

        // 1. Check Product first (most common)
        $product = Product::where('slug', $cleanSlug)->where('status', 'publish')->first();
        if ($product) {
            return app(ProductController::class)->show($cleanSlug);
        }

        // 2. Check Category
        $category = Category::where('slug', $cleanSlug)->first();
        if ($category) {
            return app(CategoryController::class)->show($cleanSlug);
        }

        // 3. Check Page
        $page = Page::where('slug', $cleanSlug)->first();
        if ($page) {
            return app(PageController::class)->show($cleanSlug);
        }

        abort(404, 'Page or chemical product not found.');
    }
}
