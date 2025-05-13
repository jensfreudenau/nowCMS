@php use Illuminate\Support\Str; @endphp
<article class="shadow-md bg-white dark:bg-gray-800 tracking-wide pb-24">
    <img
        src="{{ $content->getFirstMediaUrl('images')}}"
        alt="{{$content['header']}}_1"
    >
    <div class="text-gray-900 ">
        <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center py-11 px-52">
          <span class="font-thin text-2xl underline">
              <a href="/getCategory/{{$content->category?->name}}">{{$content->category?->name}}</a>
          </span>
        </span>
    </div>
    <h2 class="px-52 font-bold text-5xl pb-11">
        <a href="/single/{{$content->slug}}">{{$content->header}}</a>
    </h2>
    <div class="px-52 font-thin">
        @if($content->text)
            @php
                $markDownText = Str::markdown($content->text);
                $text = Str::replace('...', '.<br />', $markDownText);
            @endphp
            <p class="mb-5 font-thin">
                @if($words <= 100 )
                    {!! $text !!}
                @else
                    {!! Str::words($text, 100, '<a href="/single/' . $content->slug . '" class="block pt-3"><br>Weiterlesen <i class="fa-solid fa-arrow-right"></i></a>') !!}
                @endif
            </p>
        @endif
    </div>

    @if($words <= 100)
        <div class="justify-between items-stretch container mx-auto px-52 py-2 flex flex-wrap ">
            @php
                $uploadsAll  = $content->getMedia('default');
                $imageItemsAll = $content->getMedia('images');
                $imageItemsAll->shift();
                $imageItemsAll->all()
            @endphp
{{--            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 p-5">--}}
{{--                @foreach( $uploadsAll->all() as $key => $uploadsItem)--}}
{{--                    <div>--}}
{{--                        <x-button href="/contents/download/{{$uploadsItem->id}}" >{{$uploadsItem->name}}</x-button>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}

            @foreach( $imageItemsAll->all() as $key => $imageItem)
                <div class="flex w-1/2 flex-wrap">
                    <div class="p-1 md:p-2">
                        <a
                            class="my-image-links"
                            title="{{$content->header}}"
                            data-overlay="#222222"
                            data-maxwidth="1200px"
                            data-maxheight="400px"
                            data-gall="{{$content->category?->name}}"
                            href="{{$imageItem->getUrl()}}">
                            <img class="shadow-lg" src="{{$imageItem->getUrl('preview')}}" alt="{{$imageItem->headline}} {{$imageItem->id}}" />
                        </a>

                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="py-11 px-52">
        <div class="justify-between items-stretch container flex flex-wrap ">
            <div class="flex flex-wrap  md:p-2">
                    @foreach($tags as $tag)
                        <x-freudefoto.button-tag href="/tag/{{$tag}}" class="dark:bg-white border mb-2 mr-2 hover:bg-orange-500 border-orange-500 bg-white text-black font-normal">#{{$tag}}</x-freudefoto.button-tag>
                    @endforeach

            </div>
        </div>
    </div>
</article>
