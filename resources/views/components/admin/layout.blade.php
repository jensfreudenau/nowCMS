<x-admin.header />
<body class="h-full bg-white">
<div class="min-h-screen">
    <nav class="">
        <div class="mx-auto  px-4 sm:px-6 lg:px-8 bg-white">
            <div class="flex h-16 items-center justify-between ">

                @if (auth()->user())
                    <x-admin-nav />
                @endif
            </div>
        </div>
    </nav>

    <header class="">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="font-thin text-7xl tracking-tight text-gray-300">
                <a href="/contents">Jens' Admin Seite   </a>

            </h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 text-lg">
            <div class="space-y-4 text-white">
                <div class="text-black">{{ $slot }} </div>
            </div>
        </div>
    </main>
</div>
@stack('js_after')
</body>
</html>
