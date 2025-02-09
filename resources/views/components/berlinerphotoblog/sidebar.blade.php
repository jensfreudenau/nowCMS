<div class=" m-4 p-6 bg-white border border-gray-200 shadow-md dark:bg-white dark:border-white menu rounded-lg">
    @if(!empty($categories) && is_object($categories))
        @foreach($categories as $category)
            <div class="font-thin ">
                <x-link  href="/getCategory/{{$category->name}}">{{$category->name}}</x-link>
            </div>
        @endforeach
    @endif
</div>
