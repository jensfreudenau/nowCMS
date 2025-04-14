@push('meta_after')
    <meta name="description" content="{{config('app.berliner_photo_blog_title')}} tag {{$tag->name}}">
    <link rel="canonical" href="https://{{Config::get('domains.name.berliner_photo_blog_domain')}}/tags/{{$tag->name}}">
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
