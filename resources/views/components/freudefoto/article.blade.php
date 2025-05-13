@php use Illuminate\Support\Str; @endphp
<div class="flex flex-col">
@foreach($contents as $content)
    @php
        $words = Str::of($content['text'])->wordCount();
        $tags = $content?->tags->pluck('name', 'id');
    @endphp
    <x-freudefoto.single-article :content="$content" :words="$words" :tags="$tags"></x-freudefoto.single-article>
@endforeach
</div>
<div class="mt-4">
    {{ $contents->links() }}
</div>
