@php use Carbon\Carbon; @endphp
@push('meta_after')
    <meta name="description" content="streetphoto {{$content->metadescription}}">
    <link rel="canonical" href="https://streetphotoberlin.com/single/{{$content->slug}}">
    <title>{{config('app.streetphoto_title')}} - {{$content->header}}</title>
@endpush
<x-streetphotoberlin.layout>
    <div class="space-y-4 text-gray-700">
        <x-streetphotoberlin.article :content="$content" single="true"></x-streetphotoberlin.article>
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
