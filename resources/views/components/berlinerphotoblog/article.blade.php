@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp

<article class="text-sm">
    @php
        $media = $content->getFirstMedia('images');
        $tags = $content?->tags->pluck('name', 'id');
    @endphp
    @if($media)
        <div class="p-2 grid grid-cols-2 gap-4">
            <div class="py-2">
            <x-berlinerphotoblog.imageLink :media="$media" :content="$content" square="big_square" />
            </div>
            <div class="m-1 container px-5 py-2">
                <div class="mb-5 ">
                    <span>{{ Carbon::parse($content->date)->format('d.m.Y')}}</span>
                    <h2 class="pb-1 text-base"><a href="/single/{{$content->slug}}" >{{$content->header}}</a></h2>
                    @if(!empty($content->text))
                        <p class="mb-4"> {!!  Str::words(Str::markdown($content->text), 100, ' ...')!!} </p>
                    @endif
                    in: <a href="/getCategory/{{$content->category?->name}}">{{$content->category?->name}}</a>
                </div>
                @if($single === 'true')
                    <div class="text-gray-300">
                        @foreach($tags as $key => $tag)
                            <x-berlinerphotoblog.button-tag class=" text-gray-400" href="/tag/{{$tag}}">#{{$tag}}</x-berlinerphotoblog.button-tag>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    @endif
    @php

    @endphp

</article>
