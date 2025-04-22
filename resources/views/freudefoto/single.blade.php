@php use Illuminate\Support\Str; @endphp
@php
    $tags = $content?->tags->pluck('name', 'id');
    $mediaItemsAll = $content->getMedia('images');
    $mediaItemsAll->shift();
    $mediaItemsAll->all();
    $words = 10;
@endphp
<x-freudefoto.layout>
    @push('meta_after')
        <meta name="description" content="{{Config::get('domains.titles.freudefoto_title')}} - {{$content['metadescription']}}">
        <link rel="canonical" href="https://{{Config::get('domains.domain.freudefoto_domain')}}/single/{{$content->slug}}">
        <title>{{Config::get('domains.titles.freudefoto_title')}} - {!! Str::words($content->header, 10) !!}</title>
    @endpush
    <x-slot:heading></x-slot:heading>
        <x-freudefoto.single-article :content="$content" :words="$words" :tags="$tags"></x-freudefoto.single-article>

            @if (auth()->user())
                <div class="py-5">
                    <x-button-edit href="{{ route('contents.update', $content->id) }}" target="_blank">Edit</x-button-edit>
                </div>
            @endif



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
