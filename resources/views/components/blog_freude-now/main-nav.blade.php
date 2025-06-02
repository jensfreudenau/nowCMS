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
            <li><x-link class="text-pink-500" href="https://{{Config::get('domains.domain.freude_now_blog_domain')}}" title="Blog">{{__('Blog')}} -</x-link></li>
            <li><x-link class="text-pink-500" href="https://{{Config::get('domains.domain.freude_now_blog_domain')}}/about" title="about">{{__('about')}}</x-link></li>
        </ul>

        <form action="{{ route('search') }}" method="GET">
            <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button" class="text-gray-500 inline-flex items-center justify-center dark:text-gray-400 hover:bg-gray-100 w-10 h-10 dark:hover:bg-gray-700   dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                <svg id="theme-toggle-dark-icon" class="w-4 h-4 hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="M17.8 13.75a1 1 0 0 0-.859-.5A7.488 7.488 0 0 1 10.52 2a1 1 0 0 0 0-.969A1.035 1.035 0 0 0 9.687.5h-.113a9.5 9.5 0 1 0 8.222 14.247 1 1 0 0 0 .004-.997Z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 15a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm0-11a1 1 0 0 0 1-1V1a1 1 0 0 0-2 0v2a1 1 0 0 0 1 1Zm0 12a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1ZM4.343 5.757a1 1 0 0 0 1.414-1.414L4.343 2.929a1 1 0 0 0-1.414 1.414l1.414 1.414Zm11.314 8.486a1 1 0 0 0-1.414 1.414l1.414 1.414a1 1 0 0 0 1.414-1.414l-1.414-1.414ZM4 10a1 1 0 0 0-1-1H1a1 1 0 0 0 0 2h2a1 1 0 0 0 1-1Zm15-1h-2a1 1 0 1 0 0 2h2a1 1 0 0 0 0-2ZM4.343 14.243l-1.414 1.414a1 1 0 1 0 1.414 1.414l1.414-1.414a1 1 0 0 0-1.414-1.414ZM14.95 6.05a1 1 0 0 0 .707-.293l1.414-1.414a1 1 0 1 0-1.414-1.414l-1.414 1.414a1 1 0 0 0 .707 1.707Z"></path>
                </svg>
                <span class="sr-only">Toggle dark mode</span>
            </button>
            <input type="text" name="search" class="border-0 border-b-2 border-gray-300 bg-gray-50" placeholder="Suche">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass fa-lg text-gray-500"></i>
            </button>
        </form>
    </div>

    <!-- Mobile Menü -->
    <ul id="mobile-menu" class="hidden flex-col items-center space-y-4 p-4 md:hidden">
        <li><x-link class="text-pink-500" href="https://freude-now.de" title="Jens Freudenau Home">Home -</x-link></li>
        <li><x-link class="text-pink-500" href="https://{{Config::get('domains.domain.freude_now_blog_domain')}}" title="Blog">{{__('Blog')}} -</x-link></li>
        <li><x-link class="text-pink-500" href="https://{{Config::get('domains.domain.freude_now_blog_domain')}}/about" title="about">{{__('about')}}</x-link></li>
    </ul>
</nav>
