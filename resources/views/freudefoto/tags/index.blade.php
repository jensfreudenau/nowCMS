
@push('meta_after')
    <meta name="description" content="Jens' Reiseberichte mit dem Rennrad durch Westeuropa Tag: {{$tag->name}} ">
    <link rel="canonical" href="https://{{Config::get('domains.domain.freude_foto_domain')}}/tags/{{$tag->name}}">
    <title>{{Config::get('domains.titles.freudefoto_title')}} - Tag: {{$tag->name}}</title>
@endpush
<x-freudefoto.layout>
    <x-freudefoto.article :contents="$contents"></x-freudefoto.article>
</x-freudefoto.layout>
