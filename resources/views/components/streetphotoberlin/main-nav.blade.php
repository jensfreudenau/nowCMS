
<nav class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">


            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="/blog" title="{{__('Blog')}}" class="text-gray-700 hover:text-blue-600">{{__('Home')}}</a>

                <a href="/archive" class="text-gray-700 hover:text-blue-600" title="{{__('Archive')}}">{{__('Archive')}}</a>

                <!-- Suchfeld (Desktop) -->
                <div>
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="search" placeholder="Suche..." class="px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
                    </form>
                </div>
            </div>

            <!-- Hamburger Icon -->
            <div class="md:hidden">
                <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 space-y-2">
        <a href="/blog" title="{{__('Blog')}}" lass="block py-2 text-gray-700 hover:text-blue-600">{{__('Home')}}</a>

        <a href="/archive" class="block py-2 text-gray-700 hover:text-blue-600" title="{{__('Archive')}}">{{__('Archive')}}</a>

        <!-- Suchfeld (Mobile) -->
        <div>
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="search" placeholder="Suche..." class="w-half px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
            </form>
        </div>
    </div>
</nav>
