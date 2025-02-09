<nav class="bg-white">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <a href="/" title="Home"><img class="h-8 w-8" src="{{ URL::asset('images/logo.jpg') }} " alt="berlinerphotoblog"></a>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <x-berlinerphotoblog.nav-link href="/" :active="request()->is('/')" title="Blog">Blog</x-berlinerphotoblog.nav-link>
                    <x-berlinerphotoblog.dropdown/>
                </div>
            </div>
        </div>
        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="search" placeholder="Suche">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass fa-lg"></i>
            </button>
        </form>
        </div>
    </div>
</nav>
