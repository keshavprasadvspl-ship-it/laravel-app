<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\SeoHelper;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->with(['children', 'products' => function ($q) {
                $q->where('status', 'publish');
            }])
            ->firstOrFail();

        $products = $category->products()->paginate(24)->withQueryString();

        $seo = SeoHelper::generateTags($category, [
            'title' => "{$category->name} Manufacturer, Exporter, Supplier in India | SD International",
            'description' => "SD International is a premier manufacturer, supplier, and exporter of {$category->name} in Mumbai, India. Browse top grades and technical specifications.",
            'canonical' => url('/' . $category->slug),
            'og_type' => 'website',
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            'Products' => url('/products'),
            $category->name => url('/' . $category->slug),
        ];

        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);
        $allCategories = Category::getSidebarCategories();

        return view('categories.show', compact('category', 'products', 'seo', 'breadcrumbs', 'breadcrumbSchema', 'allCategories'));
    }
}
