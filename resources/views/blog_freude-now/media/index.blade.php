@push('meta_after')
    <meta name="description" content="{{config('domains.titles.freude_now_blog_title')}} - media overview">
    <link rel="canonical" href="https://{{Config::get('domains.domain.freude_now_blog_domain')}}/archive">
    <title>{{config('domains.titles.freude_now_blog_title')}} - media</title>
@endpush
<x-blog_freude-now.layout>
    <div class="mt-4 p-6 border-gray-50 shadow-sm bg-white border">
        <h2 class="font-thin text-5xl text-gray-900" >Medias
        </h2>
    </div>
    @foreach ($contentGrouped as $contents)
    <article class=" mt-4 p-6 bg-white border border-gray-200 shadow-md">
            {{ $contents->first()->created_at->format('m') }}
            <div class="p-5 sm:p-8">
                <div class="columns-1 gap-5 sm:columns-2 sm:gap-8 md:columns-3 lg:columns-3 [&>img:not(:first-child)]:mt-8">
                    @foreach($contents as $content)
                        @if(Str::before($content->website, '.') === Str::before(config('domains.domain.freude_now_blog_domain', env('APP_BASE_DOMAIN')), '.'))
                            @php $imageItems = $content->getMedia('images'); @endphp
                            @foreach($imageItems as $imageItem)
                                <x-blog_freude-now.imageLink :media="$imageItem" :content="$content"></x-blog_freude-now.imageLink>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
    </article>
    @endforeach
    @push('js_after')
        <script type="module">
            new VenoBox({
                toolsColor: '#944349',
                selector: '.my-image-links',
                numeration: true,
                infinigall: true,
                share: false,
                maxWidth: "1400px",
                spinner: 'rotating-plane',
                titlePosition: 'bottom'
            });
        </script>
    @endpush
</x-blog_freude-now.layout>
