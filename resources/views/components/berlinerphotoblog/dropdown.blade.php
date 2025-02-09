@if(!empty($categories) && is_object($categories))
<div class="relative group">
    <a class="hover:bg-gray-700 hover:text-white
    text-md active:font-bold inline-flex w-full justify-center gap-x-1.5 bg-white px-3 py-2 text-sm font-medium shadow-sm">
        Themen
    </a>
    <div class="absolute z-10 hidden group-hover:block ">
        <div class=" mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5">
            <div class="dropdown-menu rounded-md">
                <ul>
                    @foreach($categories as $category)
                        <li><a href="/category/{{$category->name}}" class=" hover:bg-gray-700 hover:text-white block px-4 py-2 text-sm text-gray-700 dropdown-item">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
