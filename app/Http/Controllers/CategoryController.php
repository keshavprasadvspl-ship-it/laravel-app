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

        // Direct products query - show all products without pagination
        $productsQuery = $category->products()->where('status', 'publish');

        if ($category->slug === 'liquid-solvent-dyes' && $productsQuery->count() === 0) {
            $liquidSlugs = [
                'solvent-blue-79',
                'solvent-blue-98',
                'solvent-green-33',
                'solvent-orange-98',
                'solvent-red-164',
                'solvent-red-19e',
                'solvent-yellow-107',
                'solvent-yellow-124',
                'solvent-yellow-175',
            ];
            $matchedProducts = Product::whereIn('slug', $liquidSlugs)->where('status', 'publish')->orderBy('title')->get();
            if ($matchedProducts->isNotEmpty()) {
                try {
                    $category->products()->syncWithoutDetaching($matchedProducts->pluck('id')->toArray());
                    if (empty($category->image_url)) {
                        $category->image_url = '/uploads/2026/04/solvent-dyes-e1775805465464.jpg';
                        $category->save();
                    }
                } catch (\Throwable $e) {}
                $products = $matchedProducts;
            } else {
                $products = $productsQuery->orderBy('title')->get();
            }
        } elseif ($category->products()->where('status', 'publish')->count() === 0 && $childCategories->isNotEmpty()) {
            $descendantIds = $childCategories->pluck('id')->toArray();
            $products = Product::whereHas('categories', function ($q) use ($descendantIds) {
                $q->whereIn('categories.id', $descendantIds);
            })->where('status', 'publish')->orderBy('title')->get();
        } else {
            $products = $productsQuery->orderBy('title')->get();
        }

        $seo = SeoHelper::generateTags($category, [
            'title' => "{$category->name} Manufacturer, Exporter, Supplier in India | SD International",
            'description' => "SD International is a premier manufacturer, supplier, and exporter of {$category->name} in Mumbai, India. Browse top grades and technical specifications.",
            'canonical' => url('/' . $category->slug),
            'og_type' => 'website',
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
        ];

        // Include parent category hierarchy (e.g. Home / Dyes / Direct Dyes)
        $ancestors = [];
        $curr = $category->parent;
        while ($curr) {
            $ancestors[] = $curr;
            $curr = $curr->parent;
        }

        foreach (array_reverse($ancestors) as $anc) {
            $breadcrumbs[$anc->name] = url('/' . $anc->slug);
        }

        $breadcrumbs[$category->name] = url('/' . $category->slug);

        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);
        $allCategories = Category::getSidebarCategories();

        return view('categories.show', compact('category', 'childCategories', 'products', 'seo', 'breadcrumbs', 'breadcrumbSchema', 'allCategories'));
    }
}
