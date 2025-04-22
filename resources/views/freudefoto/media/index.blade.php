@push('meta_after')
    <meta name="description" content="{{Config::get('domains.titles.freudefoto_title')}} - {{__('Medien')}}">
    <link rel="canonical" href="https://{{Config::get('domains.domain.freudefoto_domain')}}/media">
    <title>{{Config::get('domains.titles.freudefoto_title')}} - {{__('Medien')}}</title>
@endpush
<x-freudefoto.layout>

    <article class="shadow-md bg-white dark:bg-gray-800 tracking-wide pb-24">
        @foreach($categories as $category)
            @foreach($category->contents as $content)
            <img
                src="{{ $content->getFirstMediaUrl('images')}}"
                alt="{{$content['header']}}_1"
            >
            <div class="text-gray-600 italic">
                <h2 class="px-52 text-normal py-11">
                    <a href="/single/{{$content->slug}}">{{$content->header}}</a>
                </h2>
            </div>
            <div class="justify-between items-stretch container mx-auto px-52 py-2 flex flex-wrap pb-32">
                    @if(Str::before($content->website, '.') === Str::before(config('app.base_domain', env('APP_BASE_DOMAIN')), '.'))
                        @php
                            $uploadsAll  = $content->getMedia('default');
                            $imageItemsAll = $content->getMedia('images');
                            $imageItemsAll->shift();
                            $imageItemsAll->all()
                        @endphp
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
