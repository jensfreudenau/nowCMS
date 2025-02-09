<x-streetphotoberlin.header />
<x-slot:meta>Street Photos from Berlin</x-slot:meta>
<body class="h-full font-sans font-light lowercase tracking-widest text-gray-800">
<div class="min-h-screen">
    <header class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-5xl tracking-wide text-gray-600 italic">
                <a href="/">Street Photos from Berlin</a>
            </h1>
        </div>
    </header>
    <nav class="bg-white">
        <div class="mx-auto  px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="flex h-16 items-center justify-between">

                <x-streetphotoberlin.main-nav />
                <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <main class="bg-gray-50">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 text-lg">
            <div class="space-y-4">
                <div class="flex flex-row">
                    <div class="basis-3/4">
                        {{ $slot }}
                    </div>
                    <div class="basis-1/4">
                        <x-streetphotoberlin.sidebar/>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-streetphotoberlin.footer/>

</div>
@stack('js_after')
</body>
</html>
