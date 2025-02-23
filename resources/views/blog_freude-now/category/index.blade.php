@push('meta_after')
    <meta name="description" content="{{config('app.freude_now_blog_title')}} - category {{$categoryName}}">
    <link rel="canonical" href="{{Config::get('app.base_domain')}}/getCategory/{{$categoryName}}">
    <title>{{config('app.streetphoto_title')}} - category {{$categoryName}}</title>
@endpush
<x-blog_freude-now.layout>

    <div class="mt-4 p-6 border border-gray-50 shadow-sm bg-white">
        <h2 class="font-thin text-5xl text-gray-900" >{{$categoryName}}</h2>
    </div>
    @foreach($contents as $content)
        <x-blog_freude-now.article :content="$content" single="false"></x-blog_freude-now.article>
    @endforeach

</x-blog_freude-now.layout>
