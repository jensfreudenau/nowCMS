@push('meta_after')
    <meta name="description" content="{{config('app.freude_now_blog_title')}} - category {{$categoryName}}">
    <link rel="canonical" href="{{Config::get('app.base_domain')}}/getCategory/{{$categoryName}}">
    <title>{{config('app.freude_now_blog_title')}} - {{__('Kategorie')}} :: {{$categoryName}}</title>
@endpush
<x-blog_freude-now.layout>
    <div class="space-y-4 text-gray-700 m-4">
       <h2 class="text-xl tracking-tight py-3 lowercase font-bold">{{__('Kategorie')}}:&nbsp;{{$categoryName}}</h2>
        @foreach($contents as $content)
            <x-blog_freude-now.content-iterator :content="$content"></x-blog_freude-now.content-iterator>
        @endforeach
    </div>
</x-blog_freude-now.layout>

