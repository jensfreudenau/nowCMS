
@push('meta_after')
    <meta name="description" content="Jens' Reiseberichte mit dem Rennrad durch Westeuropa Kategorien">
    <link rel="canonical" href="https://freudefoto.de/tags/{{$tag->name}}">
    <title>{{config('app.freudefoto_title')}} Tag {{$tag->name}}</title>
@endpush
<x-freudefoto.layout>
    <x-freudefoto.article :contents="$contents"></x-freudefoto.article>
</x-freudefoto.layout>
