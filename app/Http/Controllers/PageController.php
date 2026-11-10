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
