<nav class="bg-nord-4 text-gray-400">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center bg-nord-4">
                <div class="flex-shrink-0">
                    <a href="/" title="Home"><img class="h-8 w-8" src="{{ URL::asset('images/logo.jpg') }}" alt="{{config('app.freudefoto_title')}} - Home" ></a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <x-freudefoto.nav-link href="/" :active="request()->is('/')" title="{{__('Blog')}}">{{__('Blog')}}</x-freudefoto.nav-link>
                        <x-freudefoto.nav-link href="/archive" :active="request()->is('/')" title="{{__('Medien')}}">{{__('Medien')}}</x-freudefoto.nav-link>
                        <x-freudefoto.dropdown/>
                    </div>
                </div>
            </div>
            @if (auth()->user())
                <x-admin-nav />
            @endif

            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="search" placeholder="{{__('Suche')}}">
                <button type="submit"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
            </form>
        </div>
    </div>
</nav>

