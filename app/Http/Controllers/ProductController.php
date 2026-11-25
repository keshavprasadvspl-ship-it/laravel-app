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
            'canonical' => url('/products/'),
            'og_image' => 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            'og_type' => 'website',
            'robots' => 'index,follow',
            'url' => url()->current(),
        ];

        return view('products.index', compact('products', 'categories', 'seo'));
    }

    public function searchApi(Request $request)
    {
        $term = trim($request->input('q') ?? $request->input('s') ?? '');
        if (strlen($term) < 2) {
            return response()->json([]);
        }

        $products = Product::where('status', 'publish')
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                  ->orWhere('cas_number', 'like', "%{$term}%")
                  ->orWhere('ci_number', 'like', "%{$term}%")
                  ->orWhere('relative_name', 'like', "%{$term}%");
            })
            ->with('categories')
            ->take(8)
            ->get();

        $results = $products->map(function ($p) {
            $cat = $p->categories->first();
            return [
                'id' => $p->id,
                'title' => $p->title,
                'slug' => $p->slug,
                'url' => url('/' . $p->slug),
                'cas_number' => $p->cas_number,
                'ci_number' => $p->ci_number,
                'category' => $cat ? $cat->name : null,
                'image_url' => $p->image_url ?: 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            ];
        });

        return response()->json($results);
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'publish')
            ->with(['categories.parent', 'seo'])
            ->firstOrFail();

        $seo = SeoHelper::generateTags($product, [
            'title' => "{$product->title} | CAS no {$product->cas_number} manufacturer, exporter, supplier in Mumbai- India",
            'description' => $product->short_description ?: "Buy high purity {$product->title} from SD International - leading manufacturer, supplier and exporter in India.",
            'canonical' => url('/' . $product->slug . '/'),
            'og_image' => $product->thumbnail_url,
            'og_type' => 'product',
        ]);

        // Choose most specific non-SEO category (prefer child category like Basic Dyes over parent Dyes)
        $cleanCats = $product->categories->filter(function ($cat) {
            return !preg_match('/(Manufacturer|Exporter|Supplier|In )/i', $cat->name);
        });
        $primaryCat = $cleanCats->first(fn ($cat) => !empty($cat->parent_id) && $cat->parent_id > 0)
            ?? $cleanCats->first()
            ?? $product->categories->first();

        // Breadcrumbs with full category hierarchy (Home / Dyes / Basic Dyes / Product)
        $breadcrumbs = [
            'Home' => url('/'),
        ];
        if ($primaryCat) {
            $catAncestors = [];
            $c = $primaryCat->parent;
            while ($c) {
                $catAncestors[] = $c;
                $c = $c->parent;
            }
            foreach (array_reverse($catAncestors) as $anc) {
                $breadcrumbs[$anc->name] = url('/' . $anc->slug . '/');
            }
            $breadcrumbs[$primaryCat->name] = url('/' . $primaryCat->slug . '/');
        }
        $breadcrumbs[$product->title] = url('/' . $product->slug . '/');

        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);
        $productSchema = SeoHelper::productSchema($product);

        // Related products (12 items = 2 rows of 6 matching live WooCommerce/Elementor template 2712 1:1)
        $relatedProducts = collect();
        $wpRelatedMapPath = database_path('data/wp_related_products.json');
        $wpRelatedLabels = [];

        if ($product->wp_id && file_exists($wpRelatedMapPath)) {
            static $wpRelatedData = null;
            if ($wpRelatedData === null) {
                $wpRelatedData = json_decode(file_get_contents($wpRelatedMapPath), true) ?: [];
            }
            $wpRelatedIds = $wpRelatedData['related'][(string) $product->wp_id] ?? [];
            $wpRelatedLabels = $wpRelatedData['labels'] ?? [];

            if (!empty($wpRelatedIds)) {
                $fetched = Product::with('categories')
                    ->whereIn('wp_id', $wpRelatedIds)
                    ->where('status', 'publish')
                    ->get()
                    ->keyBy('wp_id');

                $relatedProducts = collect($wpRelatedIds)
                    ->map(fn ($wpId) => $fetched->get($wpId))
                    ->filter()
                    ->values();
            }
        }

        // Fallback for newly created admin products not in WP snapshot
        if ($relatedProducts->isEmpty() && $primaryCat) {
            $relatedProducts = $primaryCat->products()
                ->with('categories')
                ->where('products.id', '!=', $product->id)
                ->where('products.status', 'publish')
                ->orderByDesc('wp_id')
                ->take(12)
                ->get();
        }
        if ($relatedProducts->count() < 12) {
            $excludeIds = $relatedProducts->pluck('id')->push($product->id)->all();
            $extra = Product::with('categories')
                ->whereNotIn('id', $excludeIds)
                ->where('status', 'publish')
                ->orderByDesc('wp_id')
                ->take(12 - $relatedProducts->count())
                ->get();
            $relatedProducts = $relatedProducts->concat($extra);
        }

        // Attach exact category subtitle label matching live site
        foreach ($relatedProducts as $rel) {
            $label = $wpRelatedLabels[(string) $rel->wp_id] ?? null;
            if (!$label || str_contains($label, 'Manufacturers') || str_contains($label, 'Suppliers') || str_contains($label, 'Exporters')) {
                $label = $rel->primary_category?->name ?? 'Dyes & Chemicals';
            }
            $rel->setAttribute('related_cat_label', $label);
        }

        // Process rich product content & generate dynamic TOC items
        [$renderedContent, $tocItems] = $this->prepareProductContent($product);

        $allCategories = Category::getSidebarCategories();

        return view('products.show', compact(
            'product',
            'primaryCat',
            'seo',
            'breadcrumbs',
            'breadcrumbSchema',
            'productSchema',
            'relatedProducts',
            'renderedContent',
            'tocItems',
            'allCategories'
        ));
    }

    /**
     * Printable Technical Data Sheet (TDS) PDF view.
     */
    public function tds(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'publish')
            ->with(['categories.parent'])
            ->firstOrFail();

        $cleanCats = $product->categories->filter(fn ($cat) => !preg_match('/(Manufacturer|Exporter|Supplier|In )/i', $cat->name));
        $primaryCat = $cleanCats->first(fn ($cat) => !empty($cat->parent_id) && $cat->parent_id > 0)
            ?? $cleanCats->first()
            ?? $product->categories->first();

        return view('products.tds', compact('product', 'primaryCat'));
    }

    /**
     * Transform stored WordPress product content into styled HTML matching Elementor template 2712
     * with gold CTA callout banner, functional Download PDF button, Enquiry triggers, and TOC anchors.
     */
    private function prepareProductContent(Product $product): array
    {
        $raw = trim($product->content ?? '');
        $cleanName = trim(preg_replace('/\s*\|.*$/', '', $product->title));
        $tdsUrl = route('products.tds', $product->slug);

        $pdfButtonHtml = '<a href="' . e($tdsUrl) . '" target="_blank" rel="noopener" class="sd-download-pdf-btn" title="Download Technical Data Sheet (PDF)">'
            . '<span class="sd-pdf-icon-box"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 15h6"/><path d="M9 11h6"/></svg><span>PDF</span></span>'
            . '<span class="sd-pdf-label">Download PDF</span>'
            . '</a>';

        $goldBannerHtml = '<div class="product-gold-cta-banner">'
            . 'For more detailed information about ' . e($product->title) . ' chemical, its chemical composition, physical properties, uses and applications or your exact chemical needs, call us at <a href="tel:+919920669561">+91 99206 69561</a> contact SD International.'
            . '</div>';

        if ($raw === '') {
            $attrs = is_array($product->attributes_json) ? $product->attributes_json : [];
            $synonym = $attrs['commercial-name']['value'] ?? ($product->relative_name ?: $cleanName);
            $catLabel = $product->categories->first()?->name ?? 'Dyes & Chemicals';
            $raw = "<h2>{$cleanName}</h2>\n"
                . "<p>{$cleanName} belongs to the category of {$catLabel}"
                . ($product->cas_number ? " having CAS number {$product->cas_number}." : ".")
                . ($synonym ? " The synonym of {$cleanName} is {$synonym}." : "")
                . ($product->molecular_weight ? " The molecular weight of {$cleanName} is {$product->molecular_weight} g/mol" : "")
                . ($product->molecular_formula ? " and the molecular formula is {$product->molecular_formula}." : ".")
                . ($product->ci_number ? " The colour index number is {$product->ci_number}." : "")
                . ($product->physical_appearance ? " The physical appearance of {$cleanName} is {$product->physical_appearance}." : "")
                . "</p>\n"
                . "<h3>{$cleanName} Latest Price</h3>\n"
                . "<table><tbody><tr><td>{$cleanName} latest price:</td><td>NA*</td></tr></tbody></table>\n"
                . "<p><strong><em>*Prices shown above are provisional prices and may change due to different market conditions for latest prices please Contact Us at +91 99206 69561 or send enquiry through the Enquiry Form to get the final price within hours.</em></strong></p>\n"
                . "<h4>Specifications of {$cleanName}</h4>\n"
                . "<p>{$cleanName} Technical Parameters / Specifications, please {$pdfButtonHtml}</p>\n"
                . "<p><em><strong>Note: Looking for something specific? Customisation is also available with above products. Please specify in the Enquire now page.</strong></em></p>\n";
        } else {
            // Replace legacy download.jpg image with functional Download PDF button
            $raw = preg_replace('/<img[^>]+download\.jpg[^>]*>/i', $pdfButtonHtml, $raw);

            // Convert bare text lines and raw markup into proper paragraphs using wpautop
            $raw = wpautop($raw);
        }

        // Inject Gold Gradient CTA banner right before the "Latest Price" heading (matching live Elementor 11806)
        if (preg_match('/<h[2-4][^>]*>[^<]*Latest Price[^<]*<\/h[2-4]>/i', $raw)) {
            $raw = preg_replace(
                '/(<h[2-4][^>]*>[^<]*Latest Price[^<]*<\/h[2-4]>)/i',
                $goldBannerHtml . "\n$1",
                $raw,
                1
            );
        } else {
            // Otherwise inject after first paragraph
            $raw = preg_replace('/(<\/p>)/i', "$1\n" . $goldBannerHtml, $raw, 1);
        }

        // Make "Enquiry Form" and "Enquire now page" clickable modal triggers
        $escapedTitle = addslashes($product->title);
        $escapedSlug = addslashes($product->slug);
        $raw = preg_replace(
            '/\b(Enquiry Form|Enquire now page)\b/i',
            '<a href="javascript:void(0)" class="inline-enquiry-link" onclick="openProductQuoteModal(\'' . $escapedTitle . '\', \'' . $escapedSlug . '\')">$1</a>',
            $raw
        );

        // Attach anchor IDs to all h2/h3/h4 headings and build Table of Contents array
        $tocItems = [];
        $idx = 0;
        $raw = preg_replace_callback('/<(h[2-4])([^>]*)>([\s\S]*?)<\/\1>/i', function ($m) use (&$tocItems, &$idx) {
            $tag = $m[1];
            $attrs = $m[2];
            $inner = trim(preg_replace('/\s+/', ' ', strip_tags($m[3])));
            $anchorId = 'toc-heading-' . $idx++;
            if ($inner !== '') {
                $tocItems[] = [
                    'id' => $anchorId,
                    'label' => html_entity_decode($inner, ENT_QUOTES, 'UTF-8'),
                ];
            }
            return "<{$tag} id=\"{$anchorId}\"{$attrs}>{$m[3]}</{$tag}>";
        }, $raw);

        return [$raw, $tocItems];
    }
}
