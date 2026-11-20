<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Services\SeoHelper;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(string $slug)
    {
        // Special template check for contact
        if ($slug === 'contact' || $slug === 'contact-us') {
            return $this->contact();
        }

        // Dedicated applications hub
        if ($slug === 'applications') {
            return $this->applications();
        }

        // Dedicated sustainability page
        if ($slug === 'sustainability') {
            return $this->sustainability();
        }

        // Dedicated certifications page
        if ($slug === 'certifications') {
            return $this->certifications();
        }

        // Dedicated about us page
        if ($slug === 'about-us' || $slug === 'about') {
            return $this->aboutUs();
        }

        $page = Page::where('slug', $slug)
            ->orWhere('slug', trim($slug, '/'))
            ->firstOrFail();

        // Dedicated rendering for Country Landing Pages
        if (str_contains($page->slug, '-supplier-in-') || str_contains($page->slug, '-in-')) {
            return $this->renderCountryPage($page);
        }

        $seo = SeoHelper::generateTags($page, [
            'title' => "{$page->title} | SD International",
            'description' => "Learn more about {$page->title} at SD International - premier manufacturer and global exporter of industrial dyes and chemicals.",
            'canonical' => url('/' . $page->slug),
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            $page->title => url('/' . $page->slug),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        return view('pages.show', compact('page', 'seo', 'breadcrumbs', 'breadcrumbSchema'));
    }

    public function applications()
    {
        $page = Page::where('slug', 'applications')->first();

        $seo = SeoHelper::generateTags($page, [
            'title' => 'Industrial Colorant Applications | Textiles, Plastics, Inks, Paints | SD International',
            'description' => 'Discover tailored color chemistry and industrial applications for Vat Dyes, Solvent Dyes, Pigments and Food Colours across Textiles, Plastics, Inks, Paints, Paper, and Food industries.',
            'canonical' => url('/applications'),
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            'Applications' => url('/applications'),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        return view('pages.applications', compact('page', 'seo', 'breadcrumbs', 'breadcrumbSchema'));
    }

    public function showApplication(string $slug)
    {
        $cleanSlug = trim($slug, '/');

        $aliasMap = [
            'coatings' => 'coating',
            'plastic-polymer' => 'plastic-polymers',
            'plastics-polymers' => 'plastic-polymers',
            'paper-and-pulp' => 'paper-pulp',
            'food-drugs-cosmetics' => 'food-drug-cosmetics',
            'wood-stain' => 'wood-stains',
            'smoke-dye' => 'smoke-dyes',
        ];

        $targetSlug = $aliasMap[$cleanSlug] ?? $cleanSlug;

        $page = Page::where('slug', $targetSlug)
            ->orWhere('slug', $cleanSlug)
            ->orWhere('slug', 'like', '%' . $cleanSlug . '%')
            ->first();

        if (!$page) {
            $titleSearch = str_replace('-', ' ', $cleanSlug);
            $page = Page::where('title', 'like', '%' . $titleSearch . '%')->first();
        }

        if (!$page) {
            abort(404);
        }

        if ($targetSlug === 'plastic-polymers') {
            $partialPath = resource_path('views/pages/partials/plastic_polymers_content.html');
            if (file_exists($partialPath)) {
                $content = file_get_contents($partialPath);
            } else {
                $content = $page->content;
            }
        } else {
            $content = $page->content;
        }

        // 1. Convert legacy /product/... links to direct /{slug}
        $content = preg_replace_callback('/href="\/product\/([^"]+)"/i', function ($m) {
            $parts = explode('/', trim($m[1], '/'));
            $prodSlug = end($parts);
            return 'href="/' . $prodSlug . '"';
        }, $content);

        // 2. Ensure all image tags have a valid source
        $content = preg_replace_callback('/<img([^>]+)>/i', function ($m) {
            $tag = $m[1];
            // If already an absolute URL (http/https), leave untouched
            if (preg_match('/src="https?:\/\//i', $tag)) {
                return '<img' . $tag . '>';
            }
            // If src starts with /uploads/ or /wp-content/uploads/
            if (preg_match('/src="([^"]+)"/i', $tag, $srcMatch)) {
                $src = $srcMatch[1];
                $cleanUploadPath = preg_replace('#^/(?:wp-content/)?uploads/#i', '', $src);
                $liveUrl = 'https://sdinternational.com/wp-content/uploads/' . $cleanUploadPath;
                $localPath = public_path('uploads/' . $cleanUploadPath);

                if (file_exists($localPath)) {
                    $newTag = preg_replace('/src="[^"]+"/i', 'src="' . asset('uploads/' . $cleanUploadPath) . '"', $tag);
                    if (!str_contains($newTag, 'onerror=')) {
                        $newTag .= ' onerror="this.onerror=null; this.src=\'' . $liveUrl . '\';"';
                    }
                    return '<img' . $newTag . '>';
                } else {
                    $newTag = preg_replace('/src="[^"]+"/i', 'src="' . $liveUrl . '"', $tag);
                    $newTag = preg_replace_callback('/srcset="([^"]+)"/i', function ($sm) {
                        $fixed = preg_replace('#/(?:wp-content/)?uploads/#i', 'https://sdinternational.com/wp-content/uploads/', $sm[1]);
                        return 'srcset="' . $fixed . '"';
                    }, $newTag);
                    return '<img' . $newTag . '>';
                }
            }
            return '<img' . $tag . '>';
        }, $content);

        // 3. Ensure ul has WooCommerce / product-grid classes
        $content = preg_replace('/<ul>/i', '<ul class="products columns-6 products-grid-columns-6">', $content, 1);

        $seo = SeoHelper::generateTags($page, [
            'title' => "{$page->title} Applications | SD International",
            'description' => "Explore {$page->title} industrial colorant applications at SD International.",
            'canonical' => url('/applications/' . $cleanSlug),
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            'Applications' => url('/applications'),
            $page->title => url('/applications/' . $cleanSlug),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        return view('pages.application_detail', compact('page', 'content', 'seo', 'breadcrumbs', 'breadcrumbSchema'));
    }

    public function sustainability()
    {
        $page = Page::where('slug', 'sustainability')->first();

        $seo = SeoHelper::generateTags($page, [
            'title' => 'Sustainability | Social & Environmental Responsibility | SD International',
            'description' => 'SD International is committed to sustainable chemical manufacturing, environmental responsibility, and maintaining healthy communities with eco-friendly dyes and pigments.',
            'canonical' => url('/sustainability'),
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            'Sustainability' => url('/sustainability'),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        return view('pages.sustainability', compact('page', 'seo', 'breadcrumbs', 'breadcrumbSchema'));
    }

    public function certifications()
    {
        $page = Page::where('slug', 'certifications')->first();

        $seo = SeoHelper::generateTags($page, [
            'title' => 'Certifications | ISO 9001:2015 & Export House | SD International',
            'description' => 'SD International is an ISO 9001:2015 Certified company, recognized Two Star Export House, and AEO-T1 Certified exporter by the Ministry of Finance & Commerce, India.',
            'canonical' => url('/certifications'),
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            'Certifications' => url('/certifications'),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        return view('pages.certifications', compact('page', 'seo', 'breadcrumbs', 'breadcrumbSchema'));
    }

    public function aboutUs()
    {
        $page = Page::whereIn('slug', ['about-us', 'about'])->first();

        $seo = SeoHelper::generateTags($page, [
            'title' => 'About Us | SD International - Leading Dyes & Chemicals Manufacturer',
            'description' => 'S D International is an ISO 9001: 2015-Certified premier dyes & chemicals manufacturer and supplier offering a vast portfolio of Colorants to customers across 50+ countries.',
            'canonical' => url('/about-us'),
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            'About Us' => url('/about-us'),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        return view('pages.about', compact('page', 'seo', 'breadcrumbs', 'breadcrumbSchema'));
    }

    public function contact()
    {
        $page = Page::whereIn('slug', ['contact-us', 'contact'])->first();

        $seo = SeoHelper::generateTags($page, [
            'title' => 'Contact Us | SD International - Vat & Solvent Dyes Manufacturer in India',
            'description' => 'Get in touch with SD International for high quality Vat Dyes, Solvent Dyes, Pigments, and Food Colours. Contact: +91 99206 69561 / info@sdinternational.com',
            'canonical' => url('/contact-us'),
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            'Contact Us' => url('/contact-us'),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        return view('pages.contact', compact('page', 'seo', 'breadcrumbs', 'breadcrumbSchema'));
    }

    public function requestQuote(Request $request)
    {
        $prefilledProduct = null;
        if ($request->filled('product')) {
            $prodSlug = $request->input('product');
            $prefilledProduct = Product::where('slug', $prodSlug)->orWhere('title', $prodSlug)->first();
        } elseif ($request->filled('product_id')) {
            $prefilledProduct = Product::find($request->input('product_id'));
        }

        $seo = [
            'site_name' => 'S D International',
            'title' => 'Request Commercial Quotation & Free Lab Sample | SD International Mumbai',
            'description' => 'Submit your technical specifications for bulk FOB/CIF pricing, laboratory test samples (50g-500g), Technical Data Sheets (TDS), and Material Safety Data Sheets (MSDS).',
            'canonical' => url('/request-quote'),
            'og_image' => 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            'og_type' => 'website',
            'robots' => 'index,follow',
            'url' => url()->current(),
        ];

        $breadcrumbs = [
            'Home' => url('/'),
            'Request a Quote' => url('/request-quote'),
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        return view('pages.quote', compact('prefilledProduct', 'seo', 'breadcrumbs', 'breadcrumbSchema'));
    }

    /**
     * Show country landing pages under their canonical section prefix (e.g. /dyes/dyes-supplier-in-bangladesh)
     */
    public function showCountryPage(string $prefix, string $slug)
    {
        $cleanSlug = trim($slug, " /\t\n\r\0\x0B");

        $page = Page::where('slug', $cleanSlug)
            ->orWhere('slug', $prefix . '-' . $cleanSlug)
            ->first();

        if ($page) {
            return $this->renderCountryPage($page, $prefix);
        }

        // Check if $cleanSlug is a category
        $cat = \App\Models\Category::where('slug', $cleanSlug)->first();
        if ($cat) {
            return app(CategoryController::class)->show($cat->slug);
        }

        // Check if $cleanSlug is a product
        $prod = Product::where('slug', $cleanSlug)->where('status', 'publish')->first();
        if ($prod) {
            return app(ProductController::class)->show($prod->slug);
        }

        abort(404);
    }

    /**
     * Render a country landing page with structured layout, product swatches, and sibling country navigation
     */
    public function renderCountryPage(Page $page, ?string $prefix = null)
    {
        $slug = $page->slug;

        // Deduce family prefix if not passed
        if (!$prefix) {
            if (str_starts_with($slug, 'dyes-')) {
                $prefix = 'dyes';
            } elseif (str_starts_with($slug, 'pigments-')) {
                $prefix = 'pigments';
            } elseif (str_starts_with($slug, 'f-d-c-colours-')) {
                $prefix = 'f-d-c-colours';
            } elseif (str_starts_with($slug, 'naphthols-fast-bases-fast-salts-')) {
                $prefix = 'naphthols-fast-bases-fast-salts';
            } elseif (str_starts_with($slug, 'intermediates-')) {
                $prefix = 'intermediates';
            } else {
                $prefix = 'dyes';
            }
        }

        $sectionTitles = [
            'dyes' => 'Dyes',
            'pigments' => 'Pigments',
            'f-d-c-colours' => 'F D & C Colours',
            'naphthols-fast-bases-fast-salts' => 'Naphthols, Fast Bases & Fast Salts',
            'intermediates' => 'Intermediates',
        ];

        $parentSection = [
            'slug' => $prefix,
            'title' => $sectionTitles[$prefix] ?? ucwords(str_replace('-', ' ', $prefix)),
        ];

        $canonicalUrl = url('/' . $prefix . '/' . $page->slug);
        $seo = SeoHelper::generateTags($page, [
            'title' => "{$page->title} | SD International",
            'description' => "SD International is a premier manufacturer, supplier, and exporter of {$page->title}. Browse high-grade products, technical specifications, and request quotes.",
            'canonical' => $canonicalUrl,
        ]);

        $breadcrumbs = [
            'Home' => url('/'),
            $parentSection['title'] => url('/' . $parentSection['slug']),
            $page->title => $canonicalUrl,
        ];
        $breadcrumbSchema = SeoHelper::breadcrumbSchema($breadcrumbs);

        // Fetch sibling country landing pages in the same family
        $familyPrefix = match($prefix) {
            'dyes' => 'dyes-supplier-in-',
            'pigments' => 'pigments-supplier-in-',
            'f-d-c-colours' => 'f-d-c-colours-supplier-in-',
            'naphthols-fast-bases-fast-salts' => 'naphthols-fast-bases-fast-salts-supplier-in-',
            'intermediates' => 'intermediates-supplier-in-',
            default => 'dyes-supplier-in-',
        };

        $siblings = Page::where('slug', 'like', $familyPrefix . '%')
            ->orderBy('title')
            ->get(['slug', 'title']);

        $siblingPages = [];
        foreach ($siblings as $sib) {
            $countryName = ucwords(str_replace('-', ' ', str_replace($familyPrefix, '', $sib->slug)));
            $siblingPages[] = [
                'slug' => $sib->slug,
                'title' => $sib->title,
                'country_name' => $countryName,
                'url' => '/' . $prefix . '/' . $sib->slug,
                'is_current' => $sib->slug === $page->slug,
            ];
        }

        // Transform content for seamless viewing
        $content = $page->content;

        // 1. Convert legacy /product/... links to direct /{slug}
        $content = preg_replace_callback('/href="(?:\/product\/|https:\/\/sdinternational\.com\/product\/)([^"]+)"/i', function ($m) {
            $parts = explode('/', trim($m[1], '/'));
            $productSlug = array_pop($parts);
            return 'href="/' . $productSlug . '"';
        }, $content);

        // 2. Convert /product-category/... links to direct /{slug}
        $content = preg_replace_callback('/href="(?:\/product-category\/|https:\/\/sdinternational\.com\/product-category\/)([^"]+)"/i', function ($m) {
            $parts = explode('/', trim($m[1], '/'));
            $catSlug = array_pop($parts);
            return 'href="/' . $catSlug . '"';
        }, $content);

        // 3. Mark the products <ul> with class country-products-grid
        $content = preg_replace('/<ul>(?=\s*<li[^>]*>\s*<a[^>]*>\s*<img)/i', '<ul class="country-products-grid">', $content);

        // 4. Wrap category text inside <li> in a badge
        $content = preg_replace('/(<\/a>)\s*([A-Za-z\s&;,]+?)\s*(<a[^>]*><h2>)/i', '$1<span class="country-prod-cat">$2</span>$3', $content);

        // 5. Ensure image onerror fallback to live CDN
        $content = preg_replace_callback('/<img([^>]+)src="([^"]+)"([^>]*)>/i', function($m) {
            $attrs = $m[1] . ' ' . $m[3];
            $src = $m[2];
            if (str_starts_with($src, '/wp-content/')) {
                $liveFallback = 'https://sdinternational.com' . $src;
            } elseif (str_starts_with($src, '/uploads/')) {
                $liveFallback = 'https://sdinternational.com/wp-content' . $src;
            } else {
                $liveFallback = $src;
            }
            if (!str_contains($attrs, 'onerror')) {
                return '<img' . $m[1] . 'src="' . $src . '" onerror="this.onerror=null;this.src=\'' . $liveFallback . '\';"' . $m[3] . '>';
            }
            return $m[0];
        }, $content);

        // 6. Hook up Contact Form 7 to /inquiries endpoint
        $csrfToken = csrf_token();
        $inquiriesUrl = route('inquiries.store');
        $content = preg_replace(
            '/<form action="[^"]*admin-ajax\.php[^"]*" method="post"[^>]*>/i',
            '<form action="' . $inquiriesUrl . '" method="post"><input type="hidden" name="_token" value="' . $csrfToken . '"><input type="hidden" name="inquiry_type" value="quote">',
            $content
        );

        $renderedContent = $content;

        return view('pages.country_landing', compact(
            'page',
            'renderedContent',
            'parentSection',
            'siblingPages',
            'seo',
            'breadcrumbs',
            'breadcrumbSchema'
        ));
    }
}
