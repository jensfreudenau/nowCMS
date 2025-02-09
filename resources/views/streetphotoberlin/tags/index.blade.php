<x-streetphotoberlin.layout>
    @push('meta_after')
        <meta name="description" content="{{config('app.streetphoto_title')}} - tag {{$tag->name}}">
        <link rel="canonical" href="https://streetphotoberlin.com/tags/{{$tag->name}}">
        <title>{{config('app.streetphoto_title')}} - tag {{$tag->name}}</title>
    @endpush
        <div class="mt-4 p-6 header_category  border border-gray-50 shadow-sm">
            <h2 class="font-thin text-5xl text-gray-900 lowercase">Tag: #{{$tag->name}}</h2>
        </div>
    @foreach($contents as $content)
        <x-streetphotoberlin.article :content="$content" single="false"></x-streetphotoberlin.article>
    @endforeach
</x-streetphotoberlin.layout>
