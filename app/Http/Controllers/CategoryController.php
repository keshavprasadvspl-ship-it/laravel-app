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

        if ($childCategories->isEmpty()) {
            $parentMap = [
                'dyes' => [
                    'acid-dyes',
                    'basic-dyes',
                    'cationic-dyes',
                    'direct-dyes',
                    'disperse-dyes',
                    'metal-complex-solvent-dyes',
                    'powder-solvent-dyes',
                    'reactive-dyes',
                    'vat-dyes',
                ],
                'pigments' => [
                    'organic-pigments',
                    'high-performance-pigments',
                    'fluorescent-pigments',
                    'pu-foam-pigments',
                    'ultra-marine-pigments',
                ],
                'other-products' => [
                    'naphthols',
                    'fast-colour-bases',
                    'fast-colour-salts',
                    'pyrazolone-intermediates',
                    'auxiliaries',
                ],
            ];

            if (isset($parentMap[$category->slug])) {
                $childCategories = Category::whereIn('slug', $parentMap[$category->slug])
                    ->withCount(['products' => function ($q) {
                        $q->where('status', 'publish');
                    }])
                    ->get()
                    ->sortBy(function ($cat) use ($parentMap, $category) {
                        return array_search($cat->slug, $parentMap[$category->slug]);
                    })
                    ->values();
            }
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

        // Inheritance for country-targeted and alias categories with 0 products
        $baseCategory = null;
        if ($products->isEmpty()) {
            $baseCategory = $this->resolveBaseCategory($category);
            if ($baseCategory) {
                $baseQuery = $baseCategory->products()->where('status', 'publish');
                if ($baseQuery->count() > 0) {
                    $products = $baseQuery->orderBy('title')->get();
                } else {
                    $baseChildIds = Category::where('parent_id', $baseCategory->wp_term_id ?: $baseCategory->id)
                        ->where('name', 'not like', '%Manufacturer%')
                        ->where('name', 'not like', '%In %')
                        ->pluck('id')
                        ->toArray();
                    if (!empty($baseChildIds)) {
                        $products = Product::whereHas('categories', function ($q) use ($baseChildIds) {
                            $q->whereIn('categories.id', $baseChildIds);
                        })->where('status', 'publish')->orderBy('title')->get();
                    }
                }

                if (empty($category->image_url) && !empty($baseCategory->image_url)) {
                    $category->image_url = $baseCategory->image_url;
                }
            }
        }

        $isCountryCategory = str_contains($category->name, ' in ') || str_contains($category->slug, '-in-');
        $seoTitle = $isCountryCategory
            ? "{$category->name} | SD International"
            : "{$category->name} Manufacturer, Exporter, Supplier in India | SD International";

        $seoDesc = $isCountryCategory
            ? "SD International is a premier global exporter and supplier of {$category->name}. View top industrial grades, TDS, and specifications."
            : "SD International is a premier manufacturer, supplier, and exporter of {$category->name} in Mumbai, India. Browse top grades and technical specifications.";

        $seo = SeoHelper::generateTags($category, [
            'title' => $seoTitle,
            'description' => $seoDesc,
            'canonical' => url('/' . $category->slug),
            'og_type' => 'website',
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
        ];

        // Include parent category hierarchy (e.g. Home / Dyes / Direct Dyes)
        $ancestors = [];
        $curr = $category->parent ?: ($baseCategory && $baseCategory->id !== $category->id ? $baseCategory : null);
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

    /**
     * Resolve the base product category for country-specific SEO categories or aliases
     */
    protected function resolveBaseCategory(Category $category): ?Category
    {
        if ($category->parent_id) {
            $parent = Category::where('wp_term_id', $category->parent_id)
                ->orWhere('id', $category->parent_id)
                ->first();
            if ($parent && $parent->id !== $category->id) {
                return $parent;
            }
        }

        $aliasMap = [
            'ultramarine-violet-pigment' => 'ultra-marine-pigments',
            'ultramarine-blue-pigments' => 'ultra-marine-pigments',
            'ultramarine-blue-pigment' => 'ultra-marine-pigments',
            'ultramarine-pigments' => 'ultra-marine-pigments',
            'ultramarine-pigment' => 'ultra-marine-pigments',
            'food-colours-dyes' => 'f-d-c-colours',
            'dyes-for-food-drugs-and-cosmetics' => 'f-d-c-colours',
            'dyeing-chemicals-auxiliaries' => 'auxiliaries',
            'dyes-for-petroleum-and-lubricants' => 'solvent-dyes',
            'best-pigments' => 'pigments',
            'pigment-colour-for-paints' => 'pigments',
            'dyes-for-textiles' => 'dyes',
            'dyes-for-paper-pulp' => 'dyes',
            'dyes-for-leather' => 'dyes',
            'dyes-for-plastics' => 'solvent-dyes',
            'dyes-for-the-plastics' => 'solvent-dyes',
            'best-dyes' => 'dyes',
        ];

        $baseSlug = preg_replace('/-manufacturers?-(?:exporters-suppliers-)?in-.*$/', '', $category->slug);
        $baseSlug = preg_replace('/-manufacturer-.*$/', '', $baseSlug);
        $baseSlug = preg_replace('/-in-.*$/', '', $baseSlug);

        $targetSlug = $aliasMap[$baseSlug] ?? $baseSlug;

        $base = Category::where('slug', $targetSlug)->first();
        if ($base && $base->id !== $category->id) {
            return $base;
        }

        foreach (Category::where('parent_id', 0)->orWhere('wp_term_id', '>', 0)->get() as $c) {
            if ($c->id !== $category->id && str_starts_with($category->slug, $c->slug)) {
                return $c;
            }
        }

        return null;
    }
}
