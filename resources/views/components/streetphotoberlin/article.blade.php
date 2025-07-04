@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
<article class="mt-4 p-6 bg-white border border-gray-200 shadow-md">
    <div class="flex float-right justify-between items-center mb-5 text-gray-900">
        <span class="text-sm">{{ Carbon::parse($content->date)->format('d.m.Y')}}</span>
    </div>

    <div class="m-4">
        @php
            $media = $content->getFirstMedia('images');
        @endphp
        @if($media)
            <x-streetphotoberlin.imageLink :media="$media" :content="$content"></x-streetphotoberlin.imageLink>
        @endif
    </div>
    @php
        $tags = $content?->tags->pluck('name', 'id');
        $mediaItemsAll = $content->getMedia('images');
        $numberOfImages = count($mediaItemsAll);
        $mediaItemsAll->shift();
        $mediaItemsAll->all()
    @endphp

    <div class="justify-between items-stretch">
        <div class="container mx-auto px-5 py-2">
            <div class="-m-1 flex flex-wrap ">
                @if($numberOfImages === 2)
                    <x-streetphotoberlin.twoAdditionalImages :content="$content" :mediaItemsAll="$mediaItemsAll"></x-streetphotoberlin.twoAdditionalImages>
                @else
                    <x-streetphotoberlin.multipleAdditionalImages :content="$content" :mediaItemsAll="$mediaItemsAll"></x-streetphotoberlin.multipleAdditionalImages>
                @endif
            </div>
            @if($single === 'true')
                <div class="flex justify-start"><h2 class="text-xl tracking-tight ml-3 pb-6">{{$content->header}}</h2>&nbsp; in &nbsp;
                    <h3>  <a href="/getCategory/{{$content->category?->name}}"  class="text-sm tracking-tight">{{$content->category?->name}}</a></h3></div>
            @else
                <h2 class="underline text-xl tracking-tight ml-3 pb-6 "><a href="/single/{{$content->slug}}" >{{$content->header}}</a></h2>
            @endif
            @if(!empty($content->text))
                <p class="mb-4 font-thin text-base "> {!! Str::markdown($content->text ) !!} </p>
            @endif
        </div>
        <div class="px-4">
            @foreach($tags as $key => $tag)
                <x-streetphotoberlin.button-tag href="/tag/{{$tag}}">#{{$tag}}</x-streetphotoberlin.button-tag>
            @endforeach

        </div>
    </div>
</article>
