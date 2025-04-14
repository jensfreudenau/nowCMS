<x-berlinerphotoblog.header />
<x-slot:meta>{{config('domains.titles.berliner_photo_blog_title')}}</x-slot:meta>
<body class="h-full">
<div class="min-h-screen ">
    <header class="bg-white">
        <div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 lg:px-1">
            <h1 class="font-thin text-7xl text-center text-gray-900">
                <a href="/">{{config('domains.titles.berliner_photo_blog_title')}}</a>
            </h1>
        </div>
    </header>
    <x-berlinerphotoblog.main-nav />
    <main class="bg-gray-50">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 text-lg">
            <div class="space-y-4">
                <div class="flex flex-row">
                    <div class="basis-3/3">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-berlinerphotoblog.footer/>

</div>
@stack('js_after')
</body>
</html>
