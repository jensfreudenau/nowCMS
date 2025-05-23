@push('meta_after')
    <meta name="description" content="{{config('domains.titles.berliner_photo_blog_title')}} tag {{$tag->name}}">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - tag {{$tag->name}}</title>
@endpush
<x-berlinerphotoblog.layout>
    @foreach($contents as $content)
        <x-berlinerphotoblog.article :content="$content" single="false"></x-berlinerphotoblog.article>
    @endforeach
    <div>
        {{ $contents->links() }}
    </div>
</x-berlinerphotoblog.layout>
