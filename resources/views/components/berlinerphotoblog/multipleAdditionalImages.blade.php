@php use Carbon\Carbon; @endphp
@foreach( $mediaItemsAll->all() as $key => $media)
    <div class="flex w-1/2 flex-wrap">
        <div class="p-1 md:p-2">
            <x-berlinerphotoblog.imageLink :media="$media" :content="$content"></x-berlinerphotoblog.imageLink>
            <span class="text-sm font-thin">{{ Carbon::parse($media->date)->format('d.m.Y')}}</span>
        </div>
    </div>
@endforeach
