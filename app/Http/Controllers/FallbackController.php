<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
use App\Models\Redirect;
use Illuminate\Http\Request;

class FallbackController extends Controller
{
    public function resolve(string $slug, Request $request)
    {
        $cleanSlug = trim($slug, '/');
        $fullPath = trim($request->path(), '/');

        // 1. Check SEO Redirects first
        $redirect = Redirect::where('source_pattern', $cleanSlug)
            ->orWhere('source_pattern', $fullPath)
            ->orWhere('source_pattern', '/' . $cleanSlug)
            ->orWhere('source_pattern', '/' . $fullPath)
            ->first();

        if ($redirect) {
            return redirect($redirect->destination_url, (int) $redirect->status_code);
        }

        // 2. Check Product (most common)
        $product = Product::where('slug', $cleanSlug)->where('status', 'publish')->first();
        if ($product) {
            return app(ProductController::class)->show($cleanSlug);
        }

        // 3. Check Category
        $category = Category::where('slug', $cleanSlug)->first();
        if ($category) {
            return app(CategoryController::class)->show($cleanSlug);
        }

        // 4. Check Page
        $page = Page::where('slug', $cleanSlug)->first();
        if ($page) {
            return app(PageController::class)->show($cleanSlug);
        }

        // 5. If not found, return custom branded 404
        return response()->view('errors.404', [
            'slug' => $slug,
        ], 404);
    }
}
