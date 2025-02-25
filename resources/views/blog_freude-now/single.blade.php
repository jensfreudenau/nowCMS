
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
@push('meta_after')
    <meta name="description" content="{{config('app.freude_now_blog_title')}} - {{$content->metadescription}}">
    <link rel="canonical" href="{{Config::get('app.base_domain')}}/single/{{$content->slug}}">
    <title>{{config('app.freude_now_blog_title')}} - {{$content->header}}</title>
@endpush
<x-blog_freude-now.layout>
    <div class="space-y-4 text-gray-700">
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
