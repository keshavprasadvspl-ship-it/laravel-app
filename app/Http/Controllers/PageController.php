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

        // 1. Strip staging and live external hostnames
        $content = preg_replace('#https?://(?:moccasin-worm-620280\.hostingersite\.com|sdinternational\.com)#i', '', $content);

        // 1b. Extract top intro content and active category sidebar for 2-column layout
        $introHtml = '';
        $sidebarData = [
            'category' => 'DYES',
            'category_url' => '/dyes',
            'items' => [
                ['title' => 'Vat Dyes', 'url' => '/vat-dyes'],
                ['title' => 'Solvent Dyes', 'url' => '/solvent-dyes'],
                ['title' => 'Metal Complex Solvent Dyes', 'url' => '/metal-complex-solvent-dyes'],
                ['title' => 'Disperse Dyes', 'url' => '/disperse-dyes'],
                ['title' => 'Direct Dyes', 'url' => '/direct-dyes'],
                ['title' => 'Basic Dyes', 'url' => '/basic-dyes'],
                ['title' => 'Cationic Dyes', 'url' => '/cationic-dyes'],
                ['title' => 'Acid Dyes', 'url' => '/acid-dyes'],
                ['title' => 'Reactive dyes', 'url' => '/reactive-dyes'],
            ]
        ];

        if ($prefix === 'pigments') {
            $sidebarData = [
                'category' => 'PIGMENTS',
                'category_url' => '/pigments',
                'items' => [
                    ['title' => 'Organic Pigments', 'url' => '/organic-pigments'],
                    ['title' => 'High Performance Pigments', 'url' => '/high-performance-pigments'],
                    ['title' => 'PU foam pigments', 'url' => '/pu-foam-pigments'],
                    ['title' => 'Fluorescent Pigments', 'url' => '/fluorescent-pigments'],
                ]
            ];
        }

        if (preg_match('/<!-- \.pp-modal-popup -->/i', $content, $m, PREG_OFFSET_CAPTURE)) {
            $afterPopupOffset = $m[0][1] + strlen($m[0][0]);
            $cleanTop = substr($content, $afterPopupOffset);

            $posRange = stripos($cleanTop, '<h5>Products Range</h5>');
            if ($posRange !== false) {
                $introHtml = trim(substr($cleanTop, 0, $posRange));

                if (preg_match('/<h5>Products Range<\/h5>\s*<h5><a[^>]*href="([^"]*)"[^>]*>(.*?)<\/a><\/h5>\s*<ul>(.*?)<\/ul>/is', $cleanTop, $catMatch)) {
                    $catUrl = trim($catMatch[1]);
                    $catTitle = trim(strip_tags($catMatch[2]));
                    preg_match_all('/<a[^>]*href="([^"]+)"[^>]*>(.*?)<\/a>/is', $catMatch[3], $rawItems, PREG_SET_ORDER);
                    if (!empty($rawItems)) {
                        $parsedItems = [];
                        foreach ($rawItems as $ri) {
                            $rLink = trim($ri[1]);
                            $rTitle = trim(strip_tags($ri[2]));
                            $parts = explode('/', trim($rLink, '/'));
                            $cleanLink = '/' . array_pop($parts);
                            $parsedItems[] = [
                                'title' => $rTitle,
                                'url' => $cleanLink,
                            ];
                        }
                        $sidebarData = [
                            'category' => $catTitle,
                            'category_url' => $catUrl ?: '/' . strtolower($catTitle),
                            'items' => $parsedItems,
                        ];
                    }
                }
            }

            if (preg_match('/<ul[^>]*>(?=\s*<li[^>]*>\s*<a[^>]*>\s*<img)/is', $cleanTop, $swMatch, PREG_OFFSET_CAPTURE)) {
                $content = substr($cleanTop, $swMatch[0][1]);
            }
        }

        // 2. Convert /product/... links and enrich product card titles with CAS numbers
        $content = preg_replace_callback('/<a[^>]*href="\/product\/([^"]+)"[^>]*><h2>(.*?)<\/h2><\/a>/i', function ($m) {
            $parts = explode('/', trim($m[1], '/'));
            $slug = array_pop($parts);
            $clean = trim($slug);
            $prod = Product::where('slug', $clean)
                ->orWhere('slug', $clean . '-dyes')
                ->orWhere('slug', str_replace('-dyes', '', $clean))
                ->first();
            $targetSlug = $prod ? $prod->slug : $clean;
            $targetTitle = ($prod && !empty($prod->title)) ? $prod->title : $m[2];
            return '<a href="/' . $targetSlug . '"><h2>' . e($targetTitle) . '</h2></a>';
        }, $content);

        // Also convert any remaining /product/... links (such as image wrapper anchors)
        $content = preg_replace_callback('/href="\/product\/([^"]+)"/i', function ($m) {
            $parts = explode('/', trim($m[1], '/'));
            $slug = array_pop($parts);
            $clean = trim($slug);
            $prod = Product::where('slug', $clean)
                ->orWhere('slug', $clean . '-dyes')
                ->orWhere('slug', str_replace('-dyes', '', $clean))
                ->first();
            return 'href="/' . ($prod ? $prod->slug : $clean) . '"';
        }, $content);

        // 3. Convert /product-category/... links to direct /{slug}
        $content = preg_replace_callback('/href="\/product-category\/([^"]+)"/i', function ($m) {
            $parts = explode('/', trim($m[1], '/'));
            $catSlug = array_pop($parts);
            return 'href="/' . trim($catSlug) . '"';
        }, $content);

        // 4. Mark the products <ul> with class country-products-grid
        $content = preg_replace('/<ul>(?=\s*<li[^>]*>\s*<a[^>]*>\s*<img)/i', '<ul class="country-products-grid">', $content);

        // 5. Wrap category text inside <li> in a badge
        $content = preg_replace('/(<\/a>)\s*([A-Za-z\s&;,]+?)\s*(<a[^>]*><h2>)/i', '$1<span class="country-prod-cat">$2</span>$3', $content);

        // 6. Format Industries / Applications section into 5-column responsive grid
        $appPattern = '/<a[^>]*href="\/applications\/([^"\/]+)\/?"[^>]*>\s*<img[^>]*src="([^"]+)"[^>]*>\s*<\/a>\s*<a[^>]*href="\/applications\/\1\/?"[^>]*role="button"[^>]*>\s*(.*?)\s*<\/a>/is';
        if (preg_match_all($appPattern, $content, $appMatches, PREG_SET_ORDER)) {
            $gridHtml = '<div class="country-industries-grid">';
            foreach ($appMatches as $am) {
                $appSlug = trim($am[1]);
                $appImg = trim($am[2]);
                $appTitle = trim(strip_tags($am[3]));
                $cleanImg = preg_replace('#^https?://[^/]+#', '', $appImg);
                if (!str_starts_with($cleanImg, '/')) $cleanImg = '/' . $cleanImg;
                if (str_starts_with($cleanImg, '/uploads/')) $cleanImg = '/wp-content' . $cleanImg;
                $fallback = 'https://sdinternational.com' . $cleanImg;

                $gridHtml .= '<div class="country-industry-card">';
                $gridHtml .= '  <a href="/applications/' . $appSlug . '">';
                $gridHtml .= '    <div class="country-industry-img">';
                $gridHtml .= '      <img src="' . $cleanImg . '" onerror="this.onerror=null;this.src=\'' . $fallback . '\';" alt="' . e($appTitle) . '">';
                $gridHtml .= '    </div>';
                $gridHtml .= '    <div class="country-industry-btn">' . e($appTitle) . '</div>';
                $gridHtml .= '  </a>';
                $gridHtml .= '</div>';
            }
            $gridHtml .= '</div>';

            $firstApp = $appMatches[0][0];
            $lastApp = end($appMatches)[0];
            $firstPos = strpos($content, $firstApp);
            $lastPos = strpos($content, $lastApp) + strlen($lastApp);
            if ($firstPos !== false && $lastPos !== false && $lastPos > $firstPos) {
                $content = substr($content, 0, $firstPos) . $gridHtml . substr($content, $lastPos);
            }
        }

        // 7. Format World Map and Export Destinations side-by-side section
        if (str_contains($content, 'world_map.png') && preg_match('/<p>[^<]*?destinations including India[^<]*?<\/p>(.*?)(<img[^>]*?world_map\.png[^>]*?>)/is', $content, $mapMatch)) {
            $linksHtml = trim($mapMatch[1]);
            
            // Clean country links
            $linksHtml = preg_replace('/href="(?:\/dyes\/)?dyes-supplier-in-([^"\/]+)\/?"/i', 'href="/dyes/dyes-supplier-in-$1"', $linksHtml);
            
            $destRow = '<div class="country-destinations-row">' .
                       '  <div class="country-destinations-col">' .
                       '    <h3 class="country-destinations-heading">Exporter of best quality Dyes, Pigments and Chemical Auxiliaries’ products:</h3>' .
                       '    <p class="country-destinations-sub">S D International offers product categories to companies in the sector of plastics, paints, printing inks, textiles, wood, and paper mills across markets to several destinations worldwide:</p>' .
                       '    <div class="country-destinations-links">' . $linksHtml . '</div>' .
                       '  </div>' .
                       '  <div class="country-destinations-map">' .
                       '    <img src="/wp-content/uploads/2020/07/world_map.png" onerror="this.onerror=null;this.src=\'https://sdinternational.com/wp-content/uploads/2020/07/world_map.png\';" alt="SD International Global Export Presence">' .
                       '  </div>' .
                       '</div>';

            $content = str_replace($mapMatch[0], $destRow, $content);
        }

        // 8. Ensure image onerror fallback to live CDN
        $content = preg_replace_callback('/<img([^>]+)src="([^"]+)"([^>]*)>/i', function($m) {
            $src = $m[2];
            $cleanPath = preg_replace('#^https?://[^/]+#', '', $src);
            if (!str_starts_with($cleanPath, '/')) $cleanPath = '/' . $cleanPath;
            if (str_starts_with($cleanPath, '/uploads/')) $cleanPath = '/wp-content' . $cleanPath;
            $liveFallback = 'https://sdinternational.com' . $cleanPath;
            $attrs = $m[1] . ' ' . $m[3];
            $attrs = preg_replace('/onerror="[^"]*"/i', '', $attrs);
            return '<img' . $attrs . ' src="' . $cleanPath . '" onerror="this.onerror=null;this.src=\'' . $liveFallback . '\';">';
        }, $content);

        // 9. Hook up Contact Form 7 to /inquiries endpoint
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
            'introHtml',
            'sidebarData',
            'parentSection',
            'siblingPages',
            'seo',
            'breadcrumbs',
            'breadcrumbSchema'
        ));
    }
}
