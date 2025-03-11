@push('meta_after')
    <meta name="description" content="{{config('app.freude_now_blog_title')}} - tag {{$tag->name}}">
    <link rel="canonical" href="{{Config::get('app.base_domain')}}/tags/{{$tag->name}}">
    <title>{{config('app.freude_now_blog_title')}} - {{__('Tag')}} :: {{$tag->name}}</title>
@endpush
<x-blog_freude-now.layout>
    <div class="space-y-4 text-gray-700 m-4">
        <h2 class="text-xl tracking-tight py-3 lowercase underline font-bold">{{__('Tag')}}: <i class="fa-solid fa-hashtag"></i>{{$tag->name}}</h2>
        @foreach($contents as $content)
            <x-blog_freude-now.content-iterator :content="$content"></x-blog_freude-now.content-iterator>
        @endforeach
    </div>
</x-blog_freude-now.layout>





