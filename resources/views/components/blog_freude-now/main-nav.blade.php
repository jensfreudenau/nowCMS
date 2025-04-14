<nav class="flex flex-col md:flex-row sm:flex-row mt-2">
    <div class="container mx-auto flex justify-between items-center uppercase">
        <!-- Hamburger Button -->
        <button data-collapse-toggle="navbar-default" id="menu-btn" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>

        <!-- Menü -->
        <ul id="menu" class="hidden md:flex space-x-4 text-white">
            <li><x-link class="text-pink-500" href="https://freude-now.de" title="Jens Freudenau Home">Home -</x-link></li>
            <li><x-link class="text-pink-500" href="https://{{config::get('domains.name.freude_now_blog_domain')}}" title="Blog">{{__('Blog')}} -</x-link></li>
            <li><x-link class="text-pink-500" href="https://{{config::get('domains.name.freude_now_blog_domain')}}/about" title="about">{{__('about')}}</x-link></li>
        </ul>
        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="search" class="border-0 border-b-2 border-gray-300 bg-gray-50" placeholder="Suche">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass fa-lg text-gray-500"></i>
            </button>
        </form>
    </div>

    <!-- Mobile Menü -->
    <ul id="mobile-menu" class="hidden flex-col items-center space-y-4 p-4 md:hidden">
        <li><x-link class="text-pink-500" href="https://freude-now.de" title="Jens Freudenau Home">Home -</x-link></li>
        <li><x-link class="text-pink-500" href="{{config::get('domains.name.freude_now_blog_domain')}}" title="Blog">{{__('Blog')}} -</x-link></li>
        <li><x-link class="text-pink-500" href="{{config::get('domains.name.freude_now_blog_domain')}}/about" title="about">{{__('about')}}</x-link></li>
    </ul>
</nav>
