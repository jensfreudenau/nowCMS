@push('meta_after')
    <meta name="description" content="{{config('domains.titles.freude_now_blog_title')}} - {{__('about me')}}">
    <link rel="canonical" href="https://{{Config::get('domains.domain.freude_now_blog_domain')}}/about">
    <title>{{config('domains.titles.freude_now_blog_title')}} - {{__('about me')}}</title>
@endpush
<x-blog_freude-now.layout>
    <div class="space-y-4 m-4">
        <h2 class="text-xl tracking-tight py-3 lowercase underline font-bold">{{__('about me')}}</h2>
        <ul>
            <li>👋 Hi, I’m Jens Freudenau</li>
            <li>👀 I’m interested in PHP</li>
            <li>💞️ I’m looking to collaborate on freelance projects</li>
            <li>📫 How to reach me over <a href="https://www.freude-now.de">https://www.freude-now.de</a></li>
        </ul>
    </div>

</x-blog_freude-now.layout>
