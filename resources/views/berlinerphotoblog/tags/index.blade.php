@push('meta_after')
    <meta name="description" content="{{config('app.berliner_photo_blog_title')}} tag {{$tag->name}}">
    <link rel="canonical" href="https://berlinerphotoblog.de">
    <title>{{config('app.berliner_photo_blog_title')}} - tag {{$tag->name}}</title>
@endpush
<x-berlinerphotoblog.layout>
    @foreach($contents as $content)
        <x-berlinerphotoblog.article :content="$content" single="false"></x-berlinerphotoblog.article>
    @endforeach
</x-berlinerphotoblog.layout>
