<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <span class="text-xl font-bold text-blue-600"><a href="/" title="Home"><img class="h-8 w-8" src="{{ URL::asset('images/logo.jpg') }}" alt="{{config('domains.titles.freudefoto_title')}} - Home" ></a></span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="/" title="{{__('Blog')}}" class="text-gray-700 hover:text-blue-600">{{__('Blog')}}</a>
                @if(!empty($categories) && is_object($categories))
                    <!-- Dropdown -->
                    <div class="relative group">
                        <button id="dropdown-button" class="text-gray-700 hover:text-blue-600 flex items-center">
                            {{__('Regionen')}}
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="dropdown-menu" class="absolute top-6 left-0 bg-white shadow-lg rounded-md hidden group-hover:block z-50 min-w-[150px]">
                            @foreach($categories as $category)
                                <a href="/category/{{$category->name}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <a href="/archive" class="text-gray-700 hover:text-blue-600" title="{{__('Medien')}}">{{__('Medien')}}</a>
                <div class="relative group">
                    <button id="dropdown-button-journey" class="text-gray-700 hover:text-blue-600 flex items-center">
                        {{__('Meine Radreisen')}}
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="dropdown-menu-journey" class="absolute top-6 left-0 bg-white shadow-lg rounded-md hidden group-hover:block z-50 min-w-[250px]">
                        <a href="/journey/basel-nizza" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{__('Von Basel nach Nizza')}}</a>
                    </div>
                </div>
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
        <a href="/" title="{{__('Blog')}}" lass="block py-2 text-gray-700 hover:text-blue-600">{{__('Blog')}}</a>
        @if(!empty($categories) && is_object($categories))
        <!-- Dropdown (Mobile) -->
        <div>
            <button id="mobile-dropdown-toggle" class="w-full text-left py-2 text-gray-700 hover:text-gray-600 flex justify-between items-center">
                {{__('Regionen')}}
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="mobile-dropdown-menu" class="hidden pl-4">
                @foreach($categories as $category)
                <a href="/category/{{$category->name}}" class="block py-1 text-gray-700 hover:text-blue-600">{{$category->name}}</a>
                @endforeach
            </div>
        </div>
        @endif
        <a href="/archive" class="block py-2 text-gray-700 hover:text-blue-600" title="{{__('Medien')}}">{{__('Medien')}}</a>
        <div>
            <button id="mobile-dropdown-toggle-journey" class="w-full text-left py-2 text-gray-700 hover:text-gray-600 flex justify-between items-center">
                {{__('Meine Radreisen')}}
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="mobile-dropdown-menu-journey" class="hidden pl-4">
                <a href="/journey/basel-nizza" class="block py-1 text-gray-700 hover:text-blue-600">{{__('Von Basel nach Nizza')}}</a>
            </div>
        </div>
        <!-- Suchfeld (Mobile) -->
        <div>
            <form action="{{ route('search') }}" method="GET">
            <input type="text" name="search" placeholder="Suche..." class="w-half px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
            </form>
        </div>
    </div>
</nav>
