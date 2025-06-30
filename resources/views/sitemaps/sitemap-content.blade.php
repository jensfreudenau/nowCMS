@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach ($contents as $content)
        <url>
            <loc>https://{{ $domain }}/single/{{ $content->slug }}</loc>
            <lastmod>{{ $content->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
