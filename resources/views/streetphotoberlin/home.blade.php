@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@push('meta_after')
    <meta name="description" content="Street Photos from Berlin">
    <link rel="canonical" href="https://{{Config::get('domains.domain.street_photo_blog_domain')}}/">
    <title>{{Config::get('domains.titles.streetphoto_title')}} - home</title>
@endpush
<x-streetphotoberlin.layout>

    <div class="space-y-4 text-gray-700">
        @foreach($contents as $content)
            @php
                $tags = $content?->tags->pluck('name', 'id');
            @endphp
            <article class="mt-4 p-6 bg-white border border-gray-200 shadow-md">
                <div class="m-4">
                    @php
                        $media = $content->getFirstMedia('images');
                    @endphp
                    @if($media)
                        <div class="text-xs font-sans font-thin text-right">
                            {{ Carbon::parse($content->date)->format('d.m.Y')}}
                        </div>
                        <x-streetphotoberlin.imageLink :media="$media" :content="$content"></x-streetphotoberlin.imageLink>

                    @endif
                    @if($content->text !== null)
                        <p class="mb-0 text-base">{!! Str::markdown($content->text ) !!}</p>
                    @endif
                </div>
                @php
                    $tags = $content?->tags->pluck('name', 'id');
                    $mediaItemsAll = $content->getMedia('images');
                    $mediaItemsAll->shift();
                    $mediaItemsAll->all()
                @endphp
                <div class="m-4">
                    @foreach( $mediaItemsAll->all() as $key => $mediaItems)
                        <div class="text-xs font-sans text-right font-thin">{{ Carbon::parse($mediaItems->date)->format('d.m.Y')}}</div>
                        <x-streetphotoberlin.imageLink :media="$mediaItems" :content="$content"></x-streetphotoberlin.imageLink>

                    @endforeach
                </div>

                <div class="m-4">
                    <h2 class="text-xl text-left underline decoration-pink-500 tracking-widest  pb-6 px-2.5 py-0.5"><a href="/single/{{$content->slug}}" >{{$content->header}}</a></h2>
{{--                    <div class="flex justify-between items-center mb-5 text-gray-900">--}}
{{--                    <span class="text-primary-800 text-xs inline-flex ml-3 pb-6 px-2.5 py-0.5 ">--}}
{{--                      <span class="underline">--}}
{{--                          category: <a href="/getCategory/{{$content->category?->name}}">{{$content->category?->name}}</a>--}}
{{--                      </span>--}}
{{--                    </span>--}}
{{--                    </div>--}}
                    <div class="px-3"><span class="font-light text-sm font-xs">Tags:</span>
                        @foreach($tags as $key => $tag)
                            <x-streetphotoberlin.button-tag href="/tag/{{$tag}}">#{{$tag}}</x-streetphotoberlin.button-tag>
                        @endforeach
                    </div>
                </div>

            </article>
        @endforeach
        <div>
            {{ $contents->links() }}
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
</x-streetphotoberlin.layout>
