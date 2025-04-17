@push('meta_after')
    <meta name="description" content="{{config('domains.titles.freude_now_blog_title')}} - {{__('Kategory')}}:{{$categoryName}}">
    <link rel="canonical" href="https://{{Config::get('domains.domain.freude_now_blog_domain')}}/getCategory/{{$categoryName}}">

    <title>{{config('domains.titles.freude_now_blog_title')}} - {{__('Kategorie')}} :: {{$categoryName}}</title>
@endpush
<x-blog_freude-now.layout>
    <div class="space-y-4 text-gray-700 m-4">
       <h2 class="text-xl tracking-tight py-3 lowercase font-bold">{{__('Kategorie')}}:&nbsp;{{$categoryName}}</h2>
        @foreach($contents as $content)
            <x-blog_freude-now.content-iterator :content="$content"></x-blog_freude-now.content-iterator>
        @endforeach
        <div>
            {{ $contents->links() }}
        </div>
    </div>
</x-blog_freude-now.layout>

