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
        $category = Category::where('slug', $slug)->firstOrFail();

        // Get direct child categories with product count
        $childCategories = Category::where('parent_id', $category->wp_term_id ?: $category->id)
            ->where('name', 'not like', '%Manufacturer%')
            ->where('name', 'not like', '%Exporter%')
            ->where('name', 'not like', '%Supplier%')
            ->where('name', 'not like', '%In %')
            ->withCount(['products' => function ($q) {
                $q->where('status', 'publish');
            }])
            ->orderBy('name')
            ->get();

        if ($childCategories->isEmpty()) {
            $childCategories = Category::where('parent_id', $category->id)
                ->where('name', 'not like', '%Manufacturer%')
                ->where('name', 'not like', '%Exporter%')
                ->where('name', 'not like', '%Supplier%')
                ->where('name', 'not like', '%In %')
                ->withCount(['products' => function ($q) {
                    $q->where('status', 'publish');
                }])
                ->orderBy('name')
                ->get();
        }

        // Direct products query
        $productsQuery = $category->products()->where('status', 'publish');

        if ($category->products()->where('status', 'publish')->count() === 0 && $childCategories->isNotEmpty()) {
            $descendantIds = $childCategories->pluck('id')->toArray();
            $products = Product::whereHas('categories', function ($q) use ($descendantIds) {
                $q->whereIn('categories.id', $descendantIds);
            })->where('status', 'publish')->paginate(24)->withQueryString();
        } else {
            $products = $productsQuery->paginate(24)->withQueryString();
        }

        $seo = SeoHelper::generateTags($category, [
            'title' => "{$category->name} Manufacturer, Exporter, Supplier in India | SD International",
            'description' => "SD International is a premier manufacturer, supplier, and exporter of {$category->name} in Mumbai, India. Browse top grades and technical specifications.",
            'canonical' => url('/' . $category->slug),
            'og_type' => 'website',
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            $category->name => url('/' . $category->slug),
        ];

        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);
        $allCategories = Category::getSidebarCategories();

        return view('categories.show', compact('category', 'childCategories', 'products', 'seo', 'breadcrumbs', 'breadcrumbSchema', 'allCategories'));
    }
}
