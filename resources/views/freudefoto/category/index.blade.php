
@push('meta_after')
    <meta name="description" content="{{Config::get('domains.titles.freudefoto_title')}} mit dem Rennrad durch Westeuropa - Kategorie {{$categoryName}}">
    <link rel="canonical" href="https://{{Config::get('domains.domain.freude_foto_domain')}}/getCategory/{{$categoryName}}">
    <title>{{Config::get('domains.titles.freudefoto_title')}} - Kategorie {{$categoryName}}</title>
@endpush
<x-freudefoto.layout>
    <x-freudefoto.article :contents="$contents"></x-freudefoto.article>
</x-freudefoto.layout>
