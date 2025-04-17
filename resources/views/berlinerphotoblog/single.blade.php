@push('meta_after')
    <meta name="description" content="{{config('domains.titles.berliner_photo_blog_title')}} - {{Str::words($content->header, 10)}}">
    <link rel="canonical" href="https://{{Config::get('domains.domain.berliner_photo_blog_domain')}}/single/{{$content->slug}}">
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - {{Str::words($content->header, 10)}}</title>
@endpush
<x-berlinerphotoblog.layout>
    <div class="space-y-4 text-gray-700">
         <x-berlinerphotoblog.article :content="$content" single="true"></x-berlinerphotoblog.article>
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
