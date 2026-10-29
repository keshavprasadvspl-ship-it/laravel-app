<?php

namespace App\Services;

class SeoHelper
{
    public static function generateTags($model = null, array $defaults = []): array
    {
        $siteName = 'S D International';
        $currentUrl = url()->current();

        $metaTitle = $defaults['title'] ?? 'SD International - Vat dyes, solvent dyes, disperse dyes, food colours, organic pigments manufacturer in India';
        $metaDescription = $defaults['description'] ?? 'SD International is a leading manufacturer, supplier, and exporter of Vat dyes, solvent dyes, disperse dyes, food colours, organic pigments, Naphthols, and fast bases in India.';
        $keywords = $defaults['keywords'] ?? 'vat dyes, solvent dyes, disperse dyes, organic pigments, chemical manufacturer india';
        $canonical = $defaults['canonical'] ?? $currentUrl;
        $ogImage = $defaults['og_image'] ?? 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png';
        $ogType = $defaults['og_type'] ?? 'website';
        $robots = $defaults['robots'] ?? 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large';

        if ($model && method_exists($model, 'seo') && $model->seo) {
            $seo = $model->seo;
            if (!empty($seo->meta_title)) {
                $metaTitle = $seo->meta_title;
            }
            if (!empty($seo->meta_description)) {
                $metaDescription = $seo->meta_description;
            }
            if (!empty($seo->focus_keyword)) {
                $keywords = $seo->focus_keyword;
            }
            if (!empty($seo->canonical_url)) {
                $canonical = $seo->canonical_url;
            }
            if (!empty($seo->og_image)) {
                $ogImage = $seo->og_image;
            }
            if (!empty($seo->robots)) {
                $robots = $seo->robots;
            }
        }

        return [
            'site_name' => $siteName,
            'title' => $metaTitle,
            'description' => $metaDescription,
            'keywords' => $keywords,
            'canonical' => $canonical,
            'og_image' => $ogImage,
            'og_type' => $ogType,
            'robots' => $robots,
            'url' => $currentUrl,
        ];
    }

    public static function breadcrumbSchema(array $items): string
    {
        $elements = [];
        $pos = 1;
        foreach ($items as $name => $url) {
            $elements[] = [
                '@type' => 'ListItem',
                'position' => $pos++,
                'item' => [
                    '@id' => $url,
                    'name' => $name,
                ],
            ];
        }

        return json_encode([
            '@context' => 'https://schema.org/',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $elements,
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public static function productSchema($product): string
    {
        $schema = [
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => $product->title,
            'image' => $product->image_url ?: 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            'description' => strip_tags($product->short_description ?: $product->content),
            'sku' => $product->cas_number ?: 'SD-' . $product->id,
            'mpn' => $product->ci_number ?: 'CI-' . $product->id,
            'brand' => [
                '@type' => 'Brand',
                'name' => $product->brand ?: 'S D International',
            ],
            'offers' => [
                '@type' => 'Offer',
                'url' => url('/' . $product->slug),
                'priceCurrency' => 'INR',
                'price' => '0.00',
                'priceValidUntil' => '2030-12-31',
                'availability' => 'https://schema.org/InStock',
                'itemCondition' => 'https://schema.org/NewCondition',
            ],
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public static function organizationSchema(): string
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'S D International',
            'url' => url('/'),
            'logo' => 'https://sdinternational.com/wp-content/uploads/2020/07/logo.png',
            'contactPoint' => [
                [
                    '@type' => 'ContactPoint',
                    'telephone' => '+91-9920669561',
                    'contactType' => 'customer service',
                    'areaServed' => 'IN',
                    'availableLanguage' => ['English', 'Hindi', 'Gujarati'],
                ]
            ],
            'sameAs' => [
                'https://www.facebook.com/sdinternational/',
                'https://www.linkedin.com/company/sd-international/',
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
