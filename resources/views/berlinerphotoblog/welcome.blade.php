@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@push('meta_after')
    <meta name="description" content="{{config('domains.titles.berliner_photo_blog_title')}} - Home">
    <link rel="canonical" href="https://{{Config::get('domains.domain.berliner_photo_blog_domain')}}">
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - Home</title>
@endpush
<x-berlinerphotoblog.layout>
    <div class="space-y-4 text-gray-700">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-4">
            @foreach($images as $image)
                <div class=" my-4 mx-2">
                    <a
                        class="my-image-links"
                        title="{{$image['headline']}}"
                        data-overlay="#ffffff"
                        data-maxwidth="1000px"
                        data-gall="categoryName"
                        href="{{$image['url']}}">
                        <img src="{{$image['big_square']}}" alt="{{$image['headline']}}" class="w-full h-full shadow-xl"></a>
                    <div class="flex justify-between">
                        <h3 class="text-sm pt-2 text-gray-700 ">{{$image['headline']}}</h3>
                    </div>
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
