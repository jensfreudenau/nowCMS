@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
<article class=" mt-4 p-6 bg-white border border-gray-50 shadow-sm">
    <div class="m-4">
        @php
            $media = $content->getFirstMedia('images');
        @endphp
        @if($media)
            <x-berlinerphotoblog.imageLink :media="$media" :content="$content"></x-berlinerphotoblog.imageLink>
        @endif

    </div>
    @php
        $tags = $content?->tags->pluck('name', 'id');
        $mediaItemsAll = $content->getMedia('images');
        $numberOfImages = count($mediaItemsAll);
        $mediaItemsAll->shift();
        $mediaItemsAll->all()
    @endphp

    <div class=" ">
        <div class="container mx-auto px-5 py-2">
            <div class="m-1 flex flex-wrap ">
                @if($numberOfImages === 2)
                    <x-berlinerphotoblog.twoAdditionalImages :content="$content" :mediaItemsAll="$mediaItemsAll"></x-berlinerphotoblog.twoAdditionalImages>
                @else
                    <x-berlinerphotoblog.multipleAdditionalImages :content="$content" :mediaItemsAll="$mediaItemsAll"></x-berlinerphotoblog.multipleAdditionalImages>
                @endif
            </div>
            @if($single === 'true')
                <div class="flex justify-start">
                    <h2 class="text-2xl ml-3 pb-1">{{$content->header}}</h2>&nbsp;  &nbsp;
                   </div>
            @else
                <h2 class="text-2xl ml-3 pb-1"><a href="/single/{{$content->slug}}" >{{$content->header}}</a></h2>
            @endif
        </div>
        <div class=" ">
            <div class="  ml-10 float-left   mb-5 ">
                <h3><span class="text-sm text-gray-300">{{ Carbon::parse($content->date)->format('d.m.Y')}}</span>
                <a href="/getCategory/{{$content->category?->name}}" class="font-thin text-gray-500 ml-2">{{$content->category?->name}}</a></h3>
                @if(!empty($content->text))
                    <p class="mb-4 font-thin text-base text-gray-900"> {!! Str::markdown($content->text ) !!} </p>
                @endif
            </div>

        </div>

    </div>
    <div class="p-3 pl-7 pt-16 text-gray-300">
        @foreach($tags as $key => $tag)
            <x-button-tag class="dark:bg-sky-100 p-0 m-0 bg-white" href="/tag/{{$tag}}">#{{$tag}}</x-button-tag>
        @endforeach
    </div>
</article>
