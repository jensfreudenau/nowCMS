<x-freudefoto.header />
@stack('meta')
<body class="h-full bg-nord-1">
<div class="min-h-screen">
    <header class="bg-nord-4">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="font-thin text-7xl tracking-wide text-gray-900 left-0">
                <a href="/">{{config('domains.titles.freudefoto_title')}}</a>
            </h1>
        </div>
    </header>
    <x-freudefoto.main-nav />
    @stack('js')
    <main class=" text-white">
        <div class="mx-auto   py-6 sm:px-6 lg:px-8 text-lg bg-nord-1">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </div>
    </main>
    <x-freudefoto.footer />
</div>
@stack('js_after')
</body>
</html>
