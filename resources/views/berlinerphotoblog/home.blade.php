@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@push('meta_after')
    <meta name="description" content="{{config('domains.titles.berliner_photo_blog_title')}} - Home">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - Home</title>
@endpush
<x-berlinerphotoblog.layout>
    <h2 class="border-b-1" >Blog</h2>
    <div class="space-y-4 pt-5">
        @foreach($contents as $key => $content)
            @if($content->is_text)
                <x-berlinerphotoblog.article :content="$content" :single="false"/>
            @else
                <x-berlinerphotoblog.gallery :content="$content" :single="false" gallery="blog" />
            @endif
         @endforeach
            <div class="mt-24 pt-0"></div>
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
</x-berlinerphotoblog.layout>
