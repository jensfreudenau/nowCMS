@push('meta_after')
    <meta name="description" content="{{config('app.streetphoto_title')}} - category {{$categoryName}}">
    <link rel="canonical" href="{{Config::get('app.base_domain')}}/getCategory/{{$categoryName}}">
    <title>{{config('app.streetphoto_title')}} - category {{$categoryName}}</title>
@endpush
<x-streetphotoberlin.layout>

    <div class="mt-4 p-6 border border-gray-50 shadow-sm bg-white borde">
        <h2 class="font-thin text-5xl text-gray-900" >{{$categoryName}}
        </h2>
    </div>
    @foreach($contents as $content)
        <x-streetphotoberlin.article :content="$content" single="false"></x-streetphotoberlin.article>
    @endforeach
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
