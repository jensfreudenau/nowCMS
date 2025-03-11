@php use Illuminate\Support\Str; @endphp

<article>
    <div class="justify-between items-stretch">
        <div class="container mx-auto">
            @if($single === 'true')
                <div class="justify-start py-3 ">
                    <div class="pr-4 py-2 w-full ">
                        <h2 class="text-xl font-bold">{{$content->header}}</h2>
                    </div>
                    <div class="text-xs">{{ $content->germanDate()}}</div>
                </div>
            @else
                <h2 class="underline text-xl tracking-tight ml-3 pb-6 "><a href="/single/{{$content->slug}}" >{{$content->header}}</a></h2>
            @endif
            @if(!empty($content->text))
                <div class="mb-4 font-thin text-sm"> {!! Str::markdown($content->text ) !!} </div>
            @endif
        </div>
        <div class="pb-5">
            @php
                $tags = $content?->tags->pluck('name', 'id');
            @endphp
            @foreach($tags as $key => $tag)
                <x-blog_freude-now.button-tag href="/tag/{{$tag}}"><span class="font-bold lowercase text-sm">{{$tag}}</span></x-blog_freude-now.button-tag>
            @endforeach

        </div>
    </div>
</article>
