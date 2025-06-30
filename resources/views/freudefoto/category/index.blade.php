
@push('meta_after')
    <meta name="description" content="{{Config::get('domains.titles.freudefoto_title')}} mit dem Rennrad durch Westeuropa - Kategorie {{$categoryName}}">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{Config::get('domains.titles.freudefoto_title')}} - Kategorie {{$categoryName}}</title>
@endpush
<x-freudefoto.layout>
    <x-freudefoto.article :contents="$contents"></x-freudefoto.article>
    <div class="mt-4">
        {{ $contents->links() }}
    </div>
</x-freudefoto.layout>
