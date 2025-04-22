@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@push('meta_after')
    <meta name="description" content="Jens' Reiseberichte mit dem Rennrad durch Westeuropa">
    <link rel="canonical" href="https://{{Config::get('domains.domain.freude_foto_domain')}}">
    <title>{{Config::get('domains.titles.freudefoto_title')}} - Home</title>
@endpush
<x-freudefoto.layout>
    <x-freudefoto.article :contents="$contents"></x-freudefoto.article>
</x-freudefoto.layout>
