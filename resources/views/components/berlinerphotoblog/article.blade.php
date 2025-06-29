@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
<article class="text-sm">
    @php
        $mediaFirst = $content->getFirstMedia('images');
        $tags = $content?->tags->pluck('name', 'id');
        $mediaItemsAll = $content->getMedia('images');
        $numberOfImages = count($mediaItemsAll);
        $mediaItemsAll->shift();
        $mediaItemsAll->all();
        $imgClass = '';
    @endphp
    @if($mediaFirst)
        <div class="px-2 grid grid-cols-2 gap-4 pb-8">
            <div>
                <x-berlinerphotoblog.imageLink :media="$mediaFirst" :class="$imgClass" :content="$content" square="big_square" />
            </div>
            <div class="container ml-3 px-0 border-b-1">
                <div class="relative mb-5 min-h-[570px]">
                    <!-- min-h sorgt für konstante Containerhöhe -->
                    <span>{{ Carbon::parse($content->date)->format('d.m.Y')}}</span>
                    <h2 class="pb-2 text-base"><a href="/single/{{$content->slug}}">{{$content->header}}</a></h2>
                    @if(!empty($content->text))
                        <p class="mb-1">
                            @if($single)
                                {!! Str::markdown($content->text) !!}
                            @else
                                {!! Str::words(Str::markdown($content->text), 100, ' ...') !!}
                            @endif
                        </p>
                    @endif
                    <p class="mt-2 ">
                        in: <a href="/getCategory/{{$content->category?->name}}">{{$content->category?->name}}</a>
                    </p>
                    <!-- Grid bleibt am unteren Rand -->
                    @if($single === 'true')
                        <div class="absolute bottom-0 left-0 right-0  gap-1">
                            <div class="text-gray-300">
                                @foreach($tags as $key => $tag)
                                    <x-berlinerphotoblog.button-tag class=" text-gray-400" href="/tag/{{$tag}}">#{{$tag}}</x-berlinerphotoblog.button-tag>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="absolute bottom-0 left-0 right-0 grid grid-cols-4 gap-1">
                            @php $i = 0; $imgClass = "h-32 object-contain"; @endphp
                            @foreach( $mediaItemsAll->all() as $key => $media)
                                @php
                                    $i++;
                                    if($i > 4) continue;
                                @endphp
                                <div>
                                    <x-berlinerphotoblog.imageLink :media="$media" :class="$imgClass" :content="$content" square="thumb_square" />
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
    @if($single === 'true')
    <div class="grid grid-cols-12 gap-4 px-2 pt-0">
        @php $i = 0; $imgClass = "object-contain"; @endphp
        @foreach( $mediaItemsAll->all() as $key => $media)
            <div>
                <x-berlinerphotoblog.imageLink :media="$media" :class="$imgClass" :content="$content" square="thumb_square" />
            </div>
        @endforeach
    </div>
    @endif

</article>
