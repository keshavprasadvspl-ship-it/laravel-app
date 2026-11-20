{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/products') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/blogs') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/contact-us') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
@foreach($pages as $page)
    @php
        $pageUrl = url('/' . $page->slug);
        if (str_starts_with($page->slug, 'dyes-supplier-in-')) {
            $pageUrl = url('/dyes/' . $page->slug);
        } elseif (str_starts_with($page->slug, 'pigments-supplier-in-')) {
            $pageUrl = url('/pigments/' . $page->slug);
        } elseif (str_starts_with($page->slug, 'f-d-c-colours-supplier-in-')) {
            $pageUrl = url('/f-d-c-colours/' . $page->slug);
        } elseif (str_starts_with($page->slug, 'naphthols-fast-bases-fast-salts-supplier-in-')) {
            $pageUrl = url('/naphthols-fast-bases-fast-salts/' . $page->slug);
        } elseif (str_starts_with($page->slug, 'intermediates-supplier-in-')) {
            $pageUrl = url('/intermediates/' . $page->slug);
        }
    @endphp
    <url>
        <loc>{{ $pageUrl }}</loc>
        <lastmod>{{ optional($page->updated_at)->toAtomString() ?: now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
@endforeach
</urlset>
