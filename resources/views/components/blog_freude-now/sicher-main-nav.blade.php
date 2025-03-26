<nav class="flex flex-col md:flex-row sm:flex-row mt-2">
    <div class="flex items-center">
        <div class="hidden md:block">
            <div class="flex items-baseline space-x-4 uppercase">
                <x-link class="text-pink-500" href="https://freude-now.de" title="Jens Freudenau Home">Home -</x-link>
                <x-link class="text-pink-500" href="/blog" title="Blog">Blog -</x-link>
                <x-link class="text-pink-500" href="/about" title="Archive">about</x-link>
            </div>
        </div>
    </div>
</nav>
<div class="mr-6">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="search" class="border-0 border-b-2 border-gray-300 bg-gray-50" placeholder="Suche">
        <button type="submit">
            <i class="fa-solid fa-magnifying-glass fa-lg text-gray-500"></i>
        </button>
    </form>
</div>

