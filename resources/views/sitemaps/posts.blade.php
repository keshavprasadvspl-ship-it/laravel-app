{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($posts as $post)
    <url>
        <loc>{{ url('/blogs/' . $post->slug) }}</loc>
        <lastmod>{{ optional($post->updated_at)->toAtomString() ?: now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
@endforeach
</urlset>
