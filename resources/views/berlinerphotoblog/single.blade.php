@push('meta_after')
    <meta name="description" content="{{config('domains.titles.berliner_photo_blog_title')}} - {{Str::words($content->header, 10)}}">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - {{Str::words($content->header, 10)}}</title>
@endpush
<x-berlinerphotoblog.layout>
    <h2 class="border-b-1" >{{$content->header}}</h2>
    <div class="pt-5 gap-4 text-sm">
         <x-berlinerphotoblog.article :content="$content" single="true"></x-berlinerphotoblog.article>
        <div class="mt-24 pt-0 border-b-1 border-gray-400 "></div>
        <div class="flex justify-between  pl-2 pr-1 py-1 ">
            <div>
                @if($content->previous()?->slug)
                    <a href="/single/{{$content->previous()?->slug}}">previous</a>
                @endif
            </div>
            <div>
                @if($content->next()?->slug)
                    <a href="/single/{{$content->next()?->slug}}">next</a>
                @endif
            </div>
        </div>
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
