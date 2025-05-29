{{--<nav class="bg-nord-nav text-gray-400">--}}
{{--    <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">--}}

{{--        <div class="flex h-16 items-center justify-between ">--}}
{{--            <!-- Hamburger Button -->--}}
{{--            <button data-collapse-toggle="navbar-default" id="menu-btn" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">--}}
{{--                <span class="sr-only">Open main menu</span>--}}
{{--                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">--}}
{{--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>--}}
{{--                </svg>--}}
{{--            </button>--}}
{{--            <div class="flex items-center">--}}
{{--                <div class="hidden md:block">--}}
{{--                    <div id="menu" class="ml-10 flex items-baseline space-x-4">--}}
{{--                        <x-freudefoto.nav-link href="/" :active="request()->is('/')" title="{{__('Blog')}}">{{__('Blog')}}</x-freudefoto.nav-link>--}}
{{--                        <x-freudefoto.nav-link href="/archive" :active="request()->is('/')" title="{{__('Medien')}}">{{__('Medien')}}</x-freudefoto.nav-link>--}}
{{--                        <x-freudefoto.dropdown/>--}}
{{--                        <x-freudefoto.dropdown-bikepacking/>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <form action="{{ route('search') }}" method="GET">--}}
{{--                --}}
{{--                <input type="text" name="search" placeholder="{{__('Suche')}}">--}}
{{--                <button type="submit"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Mobile Menü -->--}}
{{--    <div id="mobile-menu" class="hidden flex-col items-center space-y-4 p-4 md:hidden">--}}
{{--        <x-freudefoto.nav-link href="/" :active="request()->is('/')" title="{{__('Blog')}}">{{__('Blog')}}</x-freudefoto.nav-link>--}}
{{--        <x-freudefoto.nav-link href="/archive" :active="request()->is('/')" title="{{__('Medien')}}">{{__('Medien')}}</x-freudefoto.nav-link>--}}
{{--        <x-freudefoto.dropdown/>--}}
{{--        <x-freudefoto.dropdown-bikepacking/>--}}
{{--    </div>--}}
{{--</nav>--}}


<nav class="bg-blue-600 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="#" class="text-white text-2xl font-bold">Logo</a>
        <ul class="hidden md:flex space-x-4">
            <li><a href="#" class="text-white hover:text-blue-200">Home</a></li>
            <li><a href="#" class="text-white hover:text-blue-200">About</a></li>
            <li class="relative">
                <a href="#" class="text-white hover:text-blue-200">Services</a>
                <ul class="absolute hidden bg-blue-600 mt-2 space-y-2">
                    <li><a href="#" class="block px-4 py-2 text-white hover:bg-blue-700">Web Design</a></li>
                    <li><a href="#" class="block px-4 py-2 text-white hover:bg-blue-700">SEO</a></li>
                    <li><a href="#" class="block px-4 py-2 text-white hover:bg-blue-700">Marketing</a></li>
                </ul>
            </li>
            <li><a href="#" class="text-white hover:text-blue-200">Contact</a></li>
        </ul>
        <button class="md:hidden text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>
</nav>

<div class="md:hidden">
    <ul class="bg-blue-600 space-y-2 p-4">
        <li><a href="#" class="block text-white hover:text-blue-200">Home</a></li>
        <li><a href="#" class="block text-white hover:text-blue-200">About</a></li>
        <li>
            <a href="#" class="block text-white hover:text-blue-200">Services</a>
            <ul class="pl-4 mt-2 space-y-2">
                <li><a href="#" class="block text-white hover:text-blue-200">Web Design</a></li>
                <li><a href="#" class="block text-white hover:text-blue-200">SEO</a></li>
                <li><a href="#" class="block text-white hover:text-blue-200">Marketing</a></li>
            </ul>
        </li>
        <li><a href="#" class="block text-white hover:text-blue-200">Contact</a></li>
    </ul>
</div>


