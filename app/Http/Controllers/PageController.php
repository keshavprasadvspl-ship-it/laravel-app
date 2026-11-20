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

        // 2. Replace /wp-content/uploads/ with /uploads/
        $content = str_replace('/wp-content/uploads/', '/uploads/', $content);

        // 3. Add live CDN fallback onerror for images
        $content = preg_replace('/<img([^>]+)src="([^">]+)"([^>]*)>/i', '<img$1src="$2"$3 onerror="this.onerror=null; this.src=\'https://sdinternational.com/wp-content$2\';">', $content);

        // 4. Ensure ul has WooCommerce / product-grid classes
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
}
