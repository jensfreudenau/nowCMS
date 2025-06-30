@push('meta_after')
    <meta name="description" content="{{config('domains.titles.berliner_photo_blog_title')}} tag {{$tag->name}}">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - tag {{$tag->name}}</title>
@endpush
<x-berlinerphotoblog.layout>
    @foreach($contents as $content)
        <x-berlinerphotoblog.gallery :content="$content" single="false" :gallery="$tag->name"/>
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
</x-berlinerphotoblog.layout>
