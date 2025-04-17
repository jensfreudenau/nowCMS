@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@php
    $tags = $content?->tags->pluck('name', 'id');
    $mediaItemsAll = $content->getMedia('images');
    $mediaItemsAll->shift();
    $mediaItemsAll->all()
@endphp
<x-freudefoto.layout>
    @push('meta_after')
        <meta name="description" content="{{Config::get('domains.titles.freudefoto_title')}} - {{$content['metadescription']}}">
        <link rel="canonical" href="https://{{Config::get('domains.domain.freudefoto_domain')}}/single/{{$content->slug}}">
        <title>{{Config::get('domains.titles.freudefoto_title')}} - {!! Str::words($content->header, 10) !!}</title>
    @endpush
    <x-slot:heading></x-slot:heading>
    <div class="space-y-4 text-white">
        <article class="bg-nord-0 shadow-md dark:bg-gray-800 rounded-lg p-4">
            <div class="font-thin text-gray-500">
                <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 dark:bg-primary-200 dark:text-primary-800">
                    <span class="font-thin text-2xl tracking-tight text-nord-6 underline">
                        <a href="/getCategory/{{$content->category?->name}}">{{$content->category?->name}}</a>
                    </span>
                </span>
                <span class="text-sm text-nord-4" id="date">{{ Carbon::parse($content->date)->format('d.m.Y')}}</span>
            </div>
            <h2 class="font-thin text-5xl tracking-tight ml-3 py-6">{{$content->header}}</h2>
            <div class="font-thin m-4">
                <a
                    class="pl-5 float-right mb-5 my-image-links"
                    title="{{$content->header}}"
                    data-overlay="#CCCCCC"
                    data-maxwidth="1200px"
                    data-maxheight="400px"
                    data-gall="{{$content->category?->name}}"
                    href="{{$content->getFirstMediaUrl('images')}}">
                    <img class="float-right mb-5" src="{{$content->getFirstMediaUrl('images', 'big_preview')}}" alt="{{$content['header']}}_1" />
                </a>
                @if($content->text)
                    <p class="mb-5 font-thin">{!! Str::replace('...', '.<br />', Str::markdown($content->text)) !!}</p>
                @endif
            </div>


        <div class="justify-between items-stretch">
            <div class="container mx-auto px-5 py-2">
                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                    @foreach( $mediaItemsAll->all() as $mediaItem)
                        <div class="flex   flex-wrap">
                            <div class="p-1 md:p-2">
                                <a
                                    class="my-image-links"
                                    title="{{$content->header}}"
                                    data-overlay="#CCCCCC"
                                    data-maxwidth="1200px"
                                    data-maxheight="400px"
                                    data-gall="{{$content->category?->name}}"
                                    href="{{$mediaItem->getUrl()}}">
                                    <img class="float-right mb-5" src="{{$mediaItem->getUrl('preview')}}" alt="{{$mediaItem->headline}} {{$mediaItem->id}}" />
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="py-5">
                @foreach($tags as $tag)
                    <x-button-tag href="/tag/{{$tag}}" class="dark:bg-orange-400 bg-orange-400 hover:bg-orange-900 text-black font-normal">#{{$tag}}</x-button-tag>
                @endforeach
            </div>
            @if (auth()->user())
                <div class="py-5">
                    <x-button-edit href="{{ route('contents.update', $content->id) }}" target="_blank">Edit</x-button-edit>
                </div>
            @endif
        </div>
    </article>
    </div>
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
