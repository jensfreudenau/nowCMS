<x-freudefoto.header />
@stack('meta')
<body class="h-full bg-nord">
<div class="min-h-screen">
    <header class="black">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="font-thin text-7xl tracking-wide text-gray-300 left-0">
                <a href="/">{{config('domains.titles.freudefoto_title')}}</a>
            </h1>
        </div>
    </header>

    @stack('js')
    <main class=" text-white">

        <div class="mx-auto   py-6 sm:px-6 lg:px-8 text-lg ">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 text-black ">
                <x-freudefoto.main-nav />
                {{ $slot }}
            </div>
        </div>
    </main>
    <x-freudefoto.footer />
</div>
@stack('js_after')
</body>
</html>
