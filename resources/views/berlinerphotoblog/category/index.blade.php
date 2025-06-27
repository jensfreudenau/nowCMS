@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@push('meta_after')
    <meta name="description" content="berlinerphotoblog category {{$categoryName}}">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - {{ __('Kategorie') }} - {{$categoryName}}</title>
@endpush
<x-berlinerphotoblog.layout>
    <h2 class="border-b-1" >{{$categoryName}}</h2>
    <div class="pt-5 pl-2 pr-1 grid grid-cols-2 gap-4 border-b-1  border-black text-sm">
        @foreach($contents as $keyContent => $content)
            @php $imageItems = $content->getMedia('images'); @endphp
            @foreach($imageItems as $key => $media)
                <div class="pt-4 mb-4">
                    <x-berlinerphotoblog.imageLink :media="$media" square="big_square" :content="$content" />
                </div>
                <div class="m-1 mb-5 px-5 py-4">
                    <span>{{ Carbon::parse($content->date)->format('d.m.Y')}}</span>
                    <h2 class="text-base"><a href="/single/{{$content->slug}}" >{{$content->header}}</a></h2>
                    @if(!empty($content->text))
                        <p class="mb-4"> {!!  Str::words(Str::markdown($content->text), 100, ' ...')!!} </p>
                    @endif
                </div>
             @endforeach
        @endforeach
    </div>

        @push('js_after')
            <script type="module">
                new VenoBox({
                    toolsColor: '#944349',
                    selector: '.my-image-links',
                    numeration: true,
                    infinigall: true,
                    share: false,
                    maxWidth: "1400px",
                    spinner: 'rotating-plane',
                    titlePosition: 'bottom'
                });
            </script>
        @endpush
</x-berlinerphotoblog.layout>
