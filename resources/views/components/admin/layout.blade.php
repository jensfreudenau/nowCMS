<x-admin.header />
<body class="h-full bg-white">
<div class="min-h-screen">
    <nav class="mx-auto max-w-7xl">
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
                <a href="/contents">nowCMS</a>

            </h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 text-lg">
            <div class="space-y-4 text-white">
                <div class="py-12">
                    <div class="mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white  overflow-hidden">
                            <div class="text-black">{{ $slot }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@stack('js_after')
</body>
</html>
