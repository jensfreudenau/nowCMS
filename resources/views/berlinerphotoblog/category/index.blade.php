@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@push('meta_after')
    <meta name="description" content="berlinerphotoblog category {{$categoryName}}">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - {{ __('Kategorie') }} - {{$categoryName}}</title>
@endpush
<x-berlinerphotoblog.layout>
    <h2 class="border-b-1 " >{{$categoryName}}</h2>
    <div class="space-y-4  text-sm max-w-5xl pt-10 grid grid-cols-2 gap-4 border-b-1 border-black">

        @foreach($contents as $keyContent => $content)
            @php $imageItems = $content->getMedia('images'); @endphp
            @foreach($imageItems as $key => $media)
                <div class="p-2">
                    <x-berlinerphotoblog.imageLink :media="$media" square="big_square" :content="$content" />
                    <div class="mb-5 container px-5 py-2">
                        <span>{{ Carbon::parse($content->date)->format('d.m.Y')}}</span>
                        <h2 class="pb-1 text-base"><a href="/single/{{$content->slug}}" >{{$content->header}}</a></h2>
                    </div>
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
