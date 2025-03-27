@php
use Illuminate\Support\Str;
@endphp

@push('meta_after')
    <meta name="description" content="berlinerphotoblog category {{$categoryName}}">

    <title>{{config('app.berliner_photo_blog_title')}} - {{ __('Kategorie') }} - {{$categoryName}}</title>
@endpush
<x-berlinerphotoblog.layout>
    <div class="m-4 p-6 header_category  border border-gray-50 shadow-sm">
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
                                        <div class="mt-1 flex justify-between">
                                            <div>
                                                <h3 class="text-sm text-gray-700">{{$content->header}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                         <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 xl:gap-x-8">
                             <h2 class="text-xl tracking-tight ml-3 pb-6 "><a href="/single/{{$content->slug}}" >{{$content->header}}</a></h2>

                        @endif
                    @endif
                </div>
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
                    maxWidth: "1400px",
                    spinner: 'rotating-plane',
                    titlePosition: 'bottom'
                });
            </script>
        @endpush
</x-berlinerphotoblog.layout>
