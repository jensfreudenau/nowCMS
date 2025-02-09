<div class="flex items-center">
    <div class="flex-shrink-0">
        <a href="/" title="Home"><img class=" h-8 w-8" src="{{ URL::asset('images/logo.jpg') }} " alt="street photo berlin"></a>
    </div>
    <div class="hidden md:block">
        <div class="ml-10 flex items-baseline space-x-4 uppercase">
            <x-link  href="/" title="Blog Home">Home</x-link>
            <x-link  href="/archive" title="Archive">Archive</x-link>
        </div>
    </div>
</div>
<form action="{{ route('search') }}" method="GET">
    <input type="text" name="search" placeholder="Suche">
    <button type="submit">
        <i class="fa-solid fa-magnifying-glass fa-lg"></i>
    </button>
</form>
