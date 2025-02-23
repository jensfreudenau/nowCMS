<x-blog_freude-now.header />
<x-slot:meta>Jens Freudenau's Blog</x-slot:meta>
<body class="mx-auto flex min-h-screen max-w-6xl flex-col px-4 pt-16 font-mono text-sm font-normal antialiased sm:px-8">
<div class="min-h-screen ">
    <header class="mt-6">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <img class="mr-4 h-16  float-left" src="{{ URL::asset('images/jens_blog2.webp') }} " alt="Jens Freudenau's Blog">
            <div class="mt-2">
                <h1 class="text-lg font-bold"><a href="/" class="">{{config('app.freude_now_blog_title')}}  </a> </h1>
                <nav class="">
                    <div class="flex h-10 items-center justify-between">
                        <x-blog_freude-now.main-nav />
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <main class="p-7">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 text-lg border border-gray-200 shadow-md">
            <div class="space-y-4">
                <div class="flex flex-row">{{ $slot }}</div>
            </div>
        </div>
    </main>
    <x-blog_freude-now.footer/>
</div>
@stack('js_after')
</body>
</html>
