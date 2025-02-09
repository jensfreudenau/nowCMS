@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
<div class="flex flex-col space-y-10">
@foreach($contents as $content)
    @php
        $words = Str::of($content['text'])->wordCount();
        $tags = $content?->tags->pluck('name', 'id');
    @endphp


    <article class="shadow-md bg-nord-0 dark:bg-gray-800 rounded-lg p-4 tracking-wide">
        <div class="font-thin text-gray-500">
              <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 dark:bg-primary-200 dark:text-primary-800">
                  <span class="font-thin text-2xl text-nord-6 underline">
                      <a href="/getCategory/{{$content->category?->name}}">{{$content->category?->name}}</a>
                  </span>
              </span>
            <span class="text-sm text-nord-4">{{ Carbon::parse($content->date)->format('d.m.Y')}}</span>
        </div>
        <h2 class="font-thin text-5xl ml-3 py-6"><a href="/single/{{$content->slug}}">{{$content->header}}</a></h2>
        <div class="font-thin m-4 ">
            <img
                src="{{ $content->getFirstMediaUrl('images', 'big_preview')}}"
                alt="{{$content['header']}}_1"
                class=" pl-5 float-right mb-5"
            >
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
            <div class="justify-between items-stretch container mx-auto px-5 py-2 flex flex-wrap ">
                @php
                    $uploadsAll  = $content->getMedia('default');
                    $imageItemsAll = $content->getMedia('images');
                    $imageItemsAll->shift();
                    $imageItemsAll->all()
                @endphp
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 p-5">
                    @foreach( $uploadsAll->all() as $key => $uploadsItem)
                        <div>
                            <x-button href="/contents/download/{{$uploadsItem->id}}" >{{$uploadsItem->name}}</x-button>
                        </div>
                    @endforeach
                </div>
                @foreach( $imageItemsAll->all() as $key => $imageItem)
                    <div class="flex w-1/2 flex-wrap">
                        <div class="p-1 md:p-2">
                            <img
                                alt="{{$content->header .' '. $key}}"
                                class="shadow-lg"
                                src="{{$imageItem->getUrl('big_preview')}}"/>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="m-2">
            @foreach($tags as $tag)
                <x-button-tag href="/tag/{{$tag}}" class="dark:bg-orange-400 bg-orange-400 hover:bg-orange-900 text-black font-normal">#{{$tag}}</x-button-tag>
            @endforeach
        </div>
    </article>

@endforeach
</div>
<div class="mt-4">
    {{ $contents->links() }}
</div>
