@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@push('meta_after')
    <meta name="description" content="berlinerphotoblog category {{$categoryName}}">
    <link rel="canonical" href="{{ canonical() }}"/>
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - {{ __('Kategorie') }} - {{$categoryName}}</title>
@endpush
<x-berlinerphotoblog.layout>
    <h2 class="border-b-1" >{{$categoryName}}</h2>
    <div class="space-y-4 pt-5">
        @foreach($contents as $keyContent => $content)
            @if($content->is_text)
                <x-berlinerphotoblog.article :content="$content" :single="false"/>
            @else
                <x-berlinerphotoblog.gallery :content="$content" :single="false" :gallery="$categoryName" />
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
            @endif
        @endforeach
            <div class="mt-24 pt-0"></div>
            <div>
                {{ $contents->links() }}
            </div>
    </div>
</x-berlinerphotoblog.layout>
