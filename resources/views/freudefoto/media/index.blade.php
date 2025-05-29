@push('meta_after')
    <meta name="description" content="{{Config::get('domains.titles.freudefoto_title')}} - {{__('Medien')}}">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{Config::get('domains.titles.freudefoto_title')}} - {{__('Medien')}}</title>
@endpush
<x-freudefoto.layout>
    <article class="shadow-md dark:bg-gray-800 tracking-wide pb-24 bg-nord-nav">
        @foreach($categories as $category)
            @foreach($category->contents as $content)
            <img
                src="{{ $content->getFirstMediaUrl('images')}}"
                alt="{{$content['header']}}_1"
            >
            <div class="sm:px-16 px-10">
                <h2 class="text-normal py-11 text-gray-100  dark:text-gray-300 italic">
                    <a href="/single/{{$content->slug}}">{{$content->header}}</a>
                </h2>
                @if(Str::before($content->website, '.') === Str::before(config('app.base_domain', env('APP_BASE_DOMAIN')), '.'))
                    @php
                        $uploadsAll  = $content->getMedia('default');
                        $imageItemsAll = $content->getMedia('images');
                        $imageItemsAll->shift();
                        $imageItemsAll->all()
                    @endphp
                    @if(count($imageItemsAll))
                        <span class="justify-between items-stretch flex flex-wrap pb-32">
                            @foreach($imageItemsAll as $imageItem)
                                <div class="flex w-1/2 flex-wrap">
                                    <div class="p-1 md:p-2">
                                        <a
                                            class="my-image-links"
                                            title="{{$content->header}}"
                                            data-overlay="#222222"
                                            data-maxwidth="1200px"
                                            data-maxheight="400px"
                                            data-gall="{{$category->name}}"
                                            href="#"
                                            data-href="{{$imageItem->getUrl()}}">
                                            <img class="shadow-lg" src="{{$imageItem->getUrl('preview')}}" alt="{{$imageItem->headline}}" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </span>
                    @endif
             </div>
            @endforeach
        @endforeach
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
