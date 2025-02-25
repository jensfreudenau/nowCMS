<x-admin.layout>

                <div class="p-6 text-gray-900 pl-10">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                        @foreach($categories as $category){{$category->name}}
                        <div class="p-5 sm:p-8">
                            <div class="columns-1 gap-5 sm:columns-2 sm:gap-8 md:columns-3 lg:columns-3 [&>img:not(:first-child)]:mt-8">
                                @foreach($category->contents as $content)
                                    @php
                                        $imageItems = $content->getMedia('images');
                                    @endphp
                                    @foreach($imageItems as $imageItem)
                                        <img class="w-full max-w-full rounded-lg" src="{{$imageItem->getUrl('big_square')}}" alt="{{$imageItem->headline}}" />
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

</x-admin.layout>
