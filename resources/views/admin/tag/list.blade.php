<x-admin.layout>
    <div class="p-6 text-gray-900 pl-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2>Tag List</h2>
            <ul class="list-disc">
                @foreach($tags as $tag)
                <li>
                    <button type="button" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center       ">
                        {{$tag->name}}
                        <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold">
                            {{$tag->contentsAll()->withCount(['tags'])->get()->count()}}
                        </span>
                    </button>
                    <x-button-tag href="{{ route('admintags.edit', $tag->id) }}" class=" text-white font-normal">edit</x-button-tag>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-admin.layout>
