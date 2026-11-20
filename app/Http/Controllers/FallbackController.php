<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Page;
use App\Models\Post;
use App\Models\Redirect;
use Illuminate\Http\Request;

class FallbackController extends Controller
{
    public function resolve(string $slug, Request $request)
    {
        $cleanSlug = trim($slug, '/');
        $fullPath = trim($request->path(), '/');

        // Normalize spaces or pluses into hyphens for canonical SEO URLs
        if (preg_match('/[\s+]/', $cleanSlug)) {
            $normalizedSlug = preg_replace('/[\s+]+/', '-', $cleanSlug);
            return redirect('/' . $normalizedSlug, 301);
        }

        // 1. Check SEO Redirects first
        $redirect = Redirect::where('source_pattern', $cleanSlug)
            ->orWhere('source_pattern', $fullPath)
            ->orWhere('source_pattern', '/' . $cleanSlug)
            ->orWhere('source_pattern', '/' . $fullPath)
            ->first();

        if ($redirect) {
            return redirect($redirect->destination_url, (int) $redirect->status_code);
        }

        // Media/uploads fallback for missing assets
        if (str_starts_with($fullPath, 'uploads/') || str_starts_with($fullPath, 'wp-content/uploads/')) {
            $imgPath = preg_replace('#^(?:wp-content/)?uploads/#i', '', $fullPath);
            $localPath = public_path('uploads/' . $imgPath);
            if (file_exists($localPath)) {
                return response()->file($localPath);
            }
            return redirect('https://sdinternational.com/wp-content/uploads/' . $imgPath, 302);
        }

        // Applications sub-page handler
        if (str_starts_with($fullPath, 'applications/')) {
            $appSlug = substr($fullPath, strlen('applications/'));
            return app(PageController::class)->showApplication($appSlug);
        }

        // 2. Check Product (most common)
        $product = Product::where('slug', $cleanSlug)->where('status', 'publish')->first();
        if (!$product) {
            $product = Product::where('slug', $cleanSlug . '-dyes')
                ->orWhere('slug', str_replace('-dyes', '', $cleanSlug))
                ->where('status', 'publish')
                ->first();
            if ($product) {
                return redirect('/' . $product->slug, 301);
            }
        }
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

        // 4b. Multi-segment country landing page handler (e.g. /dyes/dyes-supplier-in-bangladesh)
        if (str_contains($cleanSlug, '/')) {
            $parts = explode('/', $cleanSlug);
            $childSlug = array_pop($parts);
            $prefix = array_shift($parts);

            $page = Page::where('slug', $childSlug)->orWhere('slug', $cleanSlug)->first();
            if ($page) {
                return app(PageController::class)->showCountryPage($prefix ?: 'dyes', $page->slug);
            }

            $category = Category::where('slug', $childSlug)->orWhere('slug', $cleanSlug)->first();
            if ($category) {
                return app(CategoryController::class)->show($category->slug);
            }

            $product = Product::where('slug', $childSlug)->orWhere('slug', $cleanSlug)->where('status', 'publish')->first();
            if ($product) {
                return app(ProductController::class)->show($product->slug);
            }
        }

        // 5. Check Blog / Post (Redirect to canonical /blogs/{slug})
        $post = Post::where('slug', $cleanSlug)->first();
        if ($post) {
            return redirect('/blogs/' . $cleanSlug, 301);
        }

        // 6. If not found, return custom branded 404
        return response()->view('errors.404', [
            'slug' => $slug,
        ], 404);
    }
}
