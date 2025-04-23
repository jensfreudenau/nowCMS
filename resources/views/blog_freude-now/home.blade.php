@push('meta_after')
    <meta name="description" content="{{config('domains.titles.freude_now_blog_title')}} :: {{__('Posts')}}">
    <link rel="canonical" href="https://{{Config::get('domains.domain.freude_now_blog_domain')}}">
    <title>{{config('domains.titles.freude_now_blog_title')}} :: {{__('Posts')}}</title>
@endpush
<x-blog_freude-now.layout>
    <div class="space-y-4 m-4">
        <h2 class="text-xl tracking-tight py-3 lowercase underline font-bold">{{__('Posts')}}</h2>
        @foreach($contents as $content)
             <x-blog_freude-now.content-iterator :content="$content"></x-blog_freude-now.content-iterator>
        @endforeach
        <div>
            {{ $contents->links() }}
        </div>
    </div>
</x-blog_freude-now.layout>
