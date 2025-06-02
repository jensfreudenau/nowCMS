
<div class="relative group">
    <a class="text-nord-6 hover:text-white rounded-md px-3 py-2 cursor-pointer">
        {{__('Regionen')}}
    </a>
    <div class="absolute z-10 hidden group-hover:block bg-nord-6 mt-2 w-56 origin-top-right  dropdown-menu ring-1 ring-black/5">
        <ul>
            @foreach($categories as $category)
                <li><a href="/category/{{$category->name}}" class="hover:underline block px-4 py-2  text-gray-700 dropdown-item rounded-md">{{$category->name}}</a></li>
            @endforeach
        </ul>

    </div>
</div>
@if(!empty($categories) && is_object($categories))
    <!-- Dropdown -->
    <div class="relative group">
        <button id="dropdown-button" class="text-gray-700 hover:text-blue-600 flex items-center">
            Services
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
