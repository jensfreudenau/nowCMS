@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
        @foreach($contents as $content)
            <url>
                <loc>https://{{ $domain }}/single/{{ $content->slug }}</loc>
               <lastmod>{{ $content->created_at->tz('UTC')->toAtomString() }}</lastmod>
                @php $imageItemsAll = $content->getMedia('images'); @endphp
                @foreach($imageItemsAll as $imageItem)
                    <image:image>

                        <image:loc>{{asset('storage/')}}/{{$imageItem->getPathRelativeToRoot()}}</image:loc>
                        <image:title>{{$imageItem->headline}}</image:title>
                    </image:image>
                @endforeach
            </url>
      @endforeach
</urlset>

