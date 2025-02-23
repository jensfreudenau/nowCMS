
@push('meta_after')
    <meta name="description" content="{{config('app.freudefoto_title')}} mit dem Rennrad durch Westeuropa - Kategorie {{$categoryName}}">
    <link rel="canonical" href="{{Config::get('app.base_domain')}}/getCategory/{{$categoryName}}">
    <title>{{config('app.freudefoto_title')}}- Kategorie {{$categoryName}}</title>
@endpush
<x-freudefoto.layout>
    <x-freudefoto.article :contents="$contents"></x-freudefoto.article>
</x-freudefoto.layout>
