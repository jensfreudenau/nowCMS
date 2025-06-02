@php
use Illuminate\Support\Str;
@endphp

@push('meta_after')
    <meta name="description" content="berlinerphotoblog category {{$categoryName}}">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - {{ __('Kategorie') }} - {{$categoryName}}</title>
@endpush
<x-berlinerphotoblog.layout>
    <div class="m-4 p-6 header_category  border border-gray-300 shadow-sm">
        <h2 class="font-thin text-5xl tracking-tight text-gray-900" >{{$categoryName}}</h2>
    </div>
    <div class="">
        <div class="p-5 sm:p-8">

                @foreach($contents as $content)
                    @if(Str::before($content->website, '.') === Str::before(config('app.base_domain', env('APP_BASE_DOMAIN')), '.'))
                        @php $imageItems = $content->getMedia('images'); @endphp
                        @if(count($imageItems))
                            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
                            @foreach($imageItems as $imageItem)
                                <a
                                    class="my-image-links"
                                    title="{{$imageItem->headline}}"
                                    data-overlay="#ffffff"
                                    data-maxwidth="1000px"
                                    data-gall="{{$categoryName}}"
                                    href="{{asset('storage/')}}/{{$imageItem->getPathRelativeToRoot()}}">
                                    <div class="group relative">
                                        <img
                                            class=""
                                            src="{{asset('storage/')}}/{{$imageItem->getPathRelativeToRoot('big_thumb_square')}}"
                                            alt="{{$imageItem->headline}}"
                                        />

                                    </div>
                                </a>
                            @endforeach
                        @else

                        @endif
                    @endif
                </div>
                @endforeach
{{--                <div>--}}
{{--                    {{ $contents->links() }}--}}
{{--                </div>--}}
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
                    maxWidth: "1400px",
                    spinner: 'rotating-plane',
                    titlePosition: 'bottom'
                });
            </script>
        @endpush
</x-berlinerphotoblog.layout>
