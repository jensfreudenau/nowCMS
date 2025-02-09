@push('meta_after')
    <meta name="description" content="{{config('app.berliner_photo_blog_title')}} - Media">
    <link rel="canonical" href="https://berlinerphotoblog.de/archive">
    <title>{{config('app.berliner_photo_blog_title')}} - media</title>
@endpush
<x-berlinerphotoblog.layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Archiv') }}
        </h2>
    </x-slot>
    <div class="text-gray-900 pl-10">
        <div class="container mx-auto">
            @foreach($categories as $category)
                <article class=" m-4 p-6 bg-gray-100 border border-gray-50 shadow-sm" id="gallery"> {{$category->name}}
                    <div class="p-5 sm:p-8">
                        <div class="columns-1 gap-5 sm:columns-2 sm:gap-8 md:columns-3 lg:columns-3 [&>img:not(:first-child)]:mt-8">
                            @foreach($category->contents as $content)
                                @if(Str::before($content->website, '.') === Str::before(config('app.base_domain', env('APP_BASE_DOMAIN')), '.'))
                                    @php $imageItems = $content->getMedia('images'); @endphp
                                    @foreach($imageItems as $imageItem)
                                        <a
                                            class="my-image-links w-1/2"
                                            title="{{$content->header}}"
                                            data-overlay="#ffffff"
                                            data-maxwidth="800px"
                                            data-gall="{{$category->name}}"
                                            href="{{asset('storage/')}}/{{$imageItem->getPathRelativeToRoot()}}">
                                                <img class="w-full max-w-full rounded-lg mb-6" src="{{asset('storage/')}}/{{$imageItem->getPathRelativeToRoot('big_square')}}" alt="{{$imageItem->headline}}" />
                                        </a>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
    @push('js_after')
        <script type="module">
            new VenoBox({
                toolsColor: '#944349',
                selector: '.my-image-links',
                numeration: true,
                infinigall: true,
                share: false,
                spinner: 'rotating-plane',
                titlePosition: 'bottom'
            });
        </script>
    @endpush
</x-berlinerphotoblog.layout>
