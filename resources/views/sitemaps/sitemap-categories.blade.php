@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($categories as $category)
        <url>
            <loc>https://{{ $domain }}/single/{{ $category->name }}</loc>
            <lastmod>{{ $category->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>yearly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>

