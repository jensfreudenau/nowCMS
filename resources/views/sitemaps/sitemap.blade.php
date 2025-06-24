<xml version="1.0" encoding="UTF-8">
    <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <sitemap>
            <loc>https://{{ $domain }}/sitemap-content.xml</loc>
            <lastmod>2025-06-23T11:23:17+00:00</lastmod>
        </sitemap>
        @if($domain !== 'blog.freude-now.de')
            <sitemap>
                <loc>https://{{ $domain }}/sitemap-images.xml</loc>
                <lastmod>2025-06-23T11:23:17+00:00</lastmod>
            </sitemap>
        @endif
        <sitemap>
            <loc>https://{{ $domain }}/sitemap-categories.xml</loc>
            <lastmod>2025-06-23T11:23:17+00:00</lastmod>
        </sitemap>
    </sitemapindex>
</xml>
