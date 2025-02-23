@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@push('meta_after')
    <meta name="description" content="Jens' Reiseberichte mit dem Rennrad durch Westeuropa">
    <link rel="canonical" href="{{Config::get('app.base_domain')}}">
    <title>{{config('app.freudefoto_title')}} - Home</title>
@endpush
<x-freudefoto.layout>
    <x-freudefoto.article :contents="$contents"></x-freudefoto.article>
</x-freudefoto.layout>
