@push('meta_after')
    <meta name="description" content="Jens' Reiseberichte mit dem Rennrad durch Westeuropa">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{Config::get('domains.titles.freudefoto_title')}} - Home</title>
@endpush
<x-freudefoto.layout>
    <x-freudefoto.article :contents="$contents"></x-freudefoto.article>
</x-freudefoto.layout>
