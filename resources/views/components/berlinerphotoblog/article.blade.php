@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
<article class="text-sm">
        <div class="px-2">
            @if($single)
                @php
                    $tags = $content?->tags->pluck('name', 'id');
                @endphp
                <h3 class="border-b-1 text-base" >{{$content->header}}</h3>
                <div class="pt-5 gap-4">
                    <article> {!! Str::markdown($content->text) !!}</article>
                </div>
            @else
                <div class="grid grid-cols-2 gap-4 pb-8 pt-8">
                    <div class="bg-gray-100 p-4">
                        <h3 class="text-base">
                            <a href="/single/{{$content->slug}}" class="hover:text-mint-500">
                                {{$content->header}}
                            </a>
                        </h3>
                    </div>
                    <div>
                        <div class="container ml-3">
                            <div class="border-b">
                                <article class="pl-3 pb-12 "><a href="/single/{{$content->slug}}" class="hover:text-mint-500"> {!! Str::markdown($content->metadescription) !!}</a></article>
                            </div>
                       <div>
                    </div>
                </div>
            @endif
        </div>
</article>
