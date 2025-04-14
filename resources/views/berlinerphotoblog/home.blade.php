@php use Carbon\Carbon; use Illuminate\Support\Str; @endphp
@push('meta_after')
    <meta name="description" content="{{config('app.berliner_photo_blog_title')}} - Home">
    <link rel="canonical" href="https://{{Config::get('domains.name.berliner_photo_blog_domain')}}">
    <title>{{config('domains.titles.berliner_photo_blog_title')}} - Home</title>
@endpush
<x-berlinerphotoblog.layout>

    <div class="space-y-4 text-gray-700 max-w-5xl">
        @foreach($contents as $content)
            @php
                $words = Str::of($content['text'])->wordCount();
                $tags = $content?->tags->pluck('name', 'id');
            @endphp
            <x-berlinerphotoblog.article :content="$content" single="false"></x-berlinerphotoblog.article>
        @endforeach
        <div>
            {{ $contents->links() }}
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
