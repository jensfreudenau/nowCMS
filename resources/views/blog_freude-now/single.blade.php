
@push('meta_after')
    <meta name="description" content="{{Config::get('domains.titles.freude_now_blog_title')}}  - {{$content->metadescription}}">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{Config::get('domains.titles.freude_now_blog_title')}} - {{$content->header}}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/obsidian.css"
    />
@endpush

<x-blog_freude-now.layout>
    <div class="space-y-4 m-4">
        <x-blog_freude-now.article :content="$content" single="true"></x-blog_freude-now.article>
    </div>
    <script>
        if (typeof hljs !== 'undefined') {
            hljs.highlightAll();
        } else {
            console.log('highlight.js not loaded');
        }

    </script>
</x-blog_freude-now.layout>
