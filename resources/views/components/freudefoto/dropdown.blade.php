@if(!empty($categories) && is_object($categories))
<div class="relative group">
    <a class="text-gray-700 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 cursor-pointer">
        {{__('Regionen')}}
    </a>
    <div class="absolute z-10 hidden group-hover:block ">
        <div class="mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5">
            <div class="dropdown-menu rounded-md">
                <ul>
                    @foreach($categories as $category)
                        <li><a href="/category/{{$category->name}}" class="hover:underline block px-4 py-2  text-gray-700 dropdown-item rounded-md">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
