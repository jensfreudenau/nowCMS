@push('meta_after')
    <meta name="description" content="{{config('app.freude_now_blog_title')}}">
    <link rel="canonical" href="{{Config::get('app.base_domain')}}">
    <title>{{config('app.freude_now_blog_title')}} - Blog :: {{__('Posts')}}</title>
@endpush
<x-blog_freude-now.layout>
    <div class="space-y-4 text-gray-700 m-4">
        <h2 class="text-xl tracking-tight py-3 lowercase underline font-bold">{{__('Posts')}}</h2>
        @foreach($contents as $content)
             <x-blog_freude-now.content-iterator :content="$content"></x-blog_freude-now.content-iterator>
        @endforeach
    </div>
</x-blog_freude-now.layout>
