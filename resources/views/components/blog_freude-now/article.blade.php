@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
<article class="mt-4 p-6">
    <div class="flex float-right justify-between items-center mb-5 text-gray-900">
        <span class="text-sm">{{ Carbon::parse($content->date)->format('d.m.Y')}}</span>
    </div>
    <div class="m-4">
        @php
            $media = $content->getFirstMedia('images');
        @endphp
        @if($media)
            <x-blog_freude-now.imageLink :media="$media" :content="$content"></x-blog_freude-now.imageLink>
        @endif
    </div>
    @php
        $tags = $content?->tags->pluck('name', 'id');
        $mediaItemsAll = $content->getMedia('images');
        if($mediaItemsAll){
            $numberOfImages = count($mediaItemsAll);
            $mediaItemsAll->shift();
            $mediaItemsAll->all();
        }
    @endphp

    <div class="justify-between items-stretch text-sm ">
        <div class="container mx-auto px-5 py-2">
            @if($single === 'true')
                <div class="flex justify-start">
                    <h2 class="text-xl tracking-tight py-3">{{$content->header}}</h2>

                </div>
            @else
                <h2 class="underline text-xl tracking-tight ml-3 pb-6 "><a href="/single/{{$content->slug}}" >{{$content->header}}</a></h2>
            @endif
            @if(!empty($content->text))
                <p class="mb-4 font-thin "> {!! Str::markdown($content->text ) !!} </p>
            @endif
        </div>
        <div class="px-4 py-6">
            @foreach($tags as $key => $tag)
                <x-blog_freude-now.button-tag href="/tag/{{$tag}}">#{{$tag}}</x-blog_freude-now.button-tag>
            @endforeach

        </div>
    </div>
</article>
