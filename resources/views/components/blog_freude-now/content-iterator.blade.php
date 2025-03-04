@php use Carbon\Carbon; @endphp
<div class="flex font-thin text-sm">
    <div class="pr-4 py-2 flex-none"><p>{{ Carbon::parse($content->date)->format('d.m.Y')}} </p></div>
    <div class="pr-4 py-2 grow ">
        <x-link href="/single/{{$content->slug}}" title="{{$content->header}}">
            <p> {{$content->header}} </p>
        </x-link>
    </div>
    <div class="py-2 flex-none">
        <p>
            <x-link  href="/getCategory/{{$content->category->name}} ">{{$content->category->name}} </x-link>
        </p>
    </div>
</div>
