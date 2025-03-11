<div class="flex flex-col md:flex-row gap-4 font-thin text-sm">
    <div class="w-[15%] "> {{ $content->germanDate() }} </div>
    <div class="w-[75%]">
        <x-link href="/single/{{$content->slug}}" title="{{$content->header}}">{{$content->header}}</x-link>
    </div>
    <div class="w-[10%]">
        <x-link class="font-bold" href="/getCategory/{{$content->category->name}} ">{{$content->category->name}} </x-link>
    </div>
</div>
