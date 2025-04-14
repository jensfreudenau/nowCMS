@push('meta_after')
    <meta name="description" content="{{Config::get('domains.titles.freudefoto_title')}} - Archive">
    <link rel="canonical" href="https://{{Config::get('domains.name.freudefoto_domain')}}/media">
    <title>{{Config::get('domains.titles.freudefoto_title')}} - Archive</title>
@endpush
<x-freudefoto.layout>

    <article
        class=" m-4 p-6 bg-nord-0 shadow-md dark:bg-gray-800 dark:border-gray-700  rounded-lg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden text-white">
                <div class=" ">
                    <div class="container mx-auto    ">
                        @foreach($categories as $category)
                            <span class="font-thin text-2xl tracking-tight text-nord-6 underline">
                                {{$category->name}}
                            </span>

                        <div class="p-5 sm:p-8">
                            <div class="columns-1 gap-5 sm:columns-2 sm:gap-8 md:columns-3 lg:columns-3 [&>img:not(:first-child)]:mt-8">
                                @foreach($category->contents as $content)
                                    @if(Str::before($content->website, '.') === Str::before(config('app.base_domain', env('APP_BASE_DOMAIN')), '.'))
                                        @php $imageItems = $content->getMedia('images'); @endphp
                                        @foreach($imageItems as $imageItem)
                                            <a
                                                class="my-image-links"
                                                title="{{$content->header}}"
                                                data-overlay="#ffffff"
                                                data-maxwidth="1000px"
                                                data-gall="{{$category->name}}"
                                                href="#"
                                                data-href="{{$imageItem->getUrl()}}">
                                                <img class="w-full max-w-full rounded-lg mb-6" src="{{$imageItem->getUrl('big_square')}}" alt="{{$imageItem->headline}}" />
                                            </a>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
         </div>
    </article>
    @push('js_after')
        <script type="module">
            new VenoBox({
                toolsColor: '#999',
                selector: '.my-image-links',
                numeration: true,
                infinigall: true,
                share: false,
                titlePosition: 'bottom',
            });
        </script>
    @endpush
</x-freudefoto.layout>
