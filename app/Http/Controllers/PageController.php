<?php

namespace App\Http\Controllers;

use App\Models\Page;
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
}
