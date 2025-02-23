@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@push('meta_after')
    <meta name="description" content="{{config('app.freude_now_blog_title')}}">
    <link rel="canonical" href="{{Config::get('app.base_domain')}}">
    <title>{{config('app.freude_now_blog_title')}} - home</title>
@endpush
<x-blog_freude-now.layout>
    <div class="space-y-4 text-gray-700 mt-4 p-6">

<div class="m-4">

        <h2 class="text-xl tracking-tight py-3">Posts</h2>
        <ul class="space-y-4 pt-7">
            @foreach($contents as $content)
                <li class="grid gap-2 sm:grid-cols-[auto_1fr] sm:[&amp;_q]:col-start-2">
                    <x-link href="/single/{{$content->slug}}" title="{{$content->header}}">
                        <span class="font-thin text-sm">{{$content->date}}</span>
                        <span class="underline tracking-wider font-thin text-base">{{$content->header}}</span>
                    </x-link>
                </li>
            @endforeach
        </ul></div>

    </div>


</x-blog_freude-now.layout>
