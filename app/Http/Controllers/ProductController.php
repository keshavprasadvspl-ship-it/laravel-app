<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\SeoHelper;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 'publish')->with('categories');

        $search = $request->input('s') ?? $request->input('search') ?? $request->input('q');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('cas_number', 'like', "%{$search}%")
                  ->orWhere('ci_number', 'like', "%{$search}%")
                  ->orWhere('relative_name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $catSlug = $request->input('category');
            $query->whereHas('categories', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        $products = $query->paginate(24)->withQueryString();

        $categories = Category::getSidebarCategories();

        $seo = [
            'site_name' => 'S D International',
            'title' => 'Products Catalog | Dyes, Pigments, Intermediates | SD International',
            'description' => 'Explore our complete catalog of industrial Dyes, Pigments, Food Colours, Naphthols, Fast Bases and chemical intermediates manufactured by SD International.',
            'canonical' => url('/products'),
            'og_image' => 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            'og_type' => 'website',
            'robots' => 'index,follow',
            'url' => url()->current(),
        ];

        return view('products.index', compact('products', 'categories', 'seo'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'publish')
            ->with(['categories', 'seo'])
            ->firstOrFail();

        $seo = SeoHelper::generateTags($product, [
            'title' => "{$product->title} | CAS no {$product->cas_number} manufacturer, exporter, supplier in Mumbai- India",
            'description' => $product->short_description ?: "Buy high purity {$product->title} from SD International - leading manufacturer, supplier and exporter in India.",
            'canonical' => url('/' . $product->slug),
            'og_image' => $product->image_url ?: 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            'og_type' => 'product',
        ]);

        // Breadcrumbs
        $primaryCat = $product->categories->first();
        $breadcrumbs = [
            'Home' => url('/'),
            'Products' => url('/products'),
        ];
        if ($primaryCat) {
            $breadcrumbs[$primaryCat->name] = url('/' . $primaryCat->slug);
        }
        $breadcrumbs[$product->title] = url('/' . $product->slug);

        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);
        $productSchema = SeoHelper::productSchema($product);

        // Related products
        $relatedProducts = collect();
        if ($primaryCat) {
            $relatedProducts = $primaryCat->products()
                ->where('products.id', '!=', $product->id)
                ->where('products.status', 'publish')
                ->take(4)
                ->get();
        }
        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::where('id', '!=', $product->id)
                ->where('status', 'publish')
                ->take(4)
                ->get();
        }

        $allCategories = Category::getSidebarCategories();

        return view('products.show', compact('product', 'seo', 'breadcrumbs', 'breadcrumbSchema', 'productSchema', 'relatedProducts', 'allCategories'));
    }
}
