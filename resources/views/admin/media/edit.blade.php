<x-admin.layout>
    <x-slot:heading></x-slot:heading>
    <x-slot:meta>Jens' Reiseberichte mit dem Rennrad durch Westeuropa</x-slot:meta>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

                <form action="{{ url('/media') }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if($message = session()->pull('success'))
                        <p>{{ $message }}</p>
                    @endif

                    @foreach($medias as $media)
                        <input type="hidden" name="medias[{{ $media->id }}][id]" value="{{ $media->id }}">
                        <div class="p-12">
                            <h2 class="text-2xl font-bold"><img class="" src="{{ asset('storage/uploads/thumbs/').'/'. $media->imageName }}" alt="{{$media->imageName}}"></h2>
                            <div class="mt-8">
                                <div class="grid grid-cols-2 gap-6">
                                    <label class="block" for="{{ $media->id }}_headline">
                                        <span class="text-gray-700">Überschrift</span>
                                        <input
                                            id="{{ $media->id }}_headline"
                                            type="text"
                                            name="medias[{{ $media->id }}][headline]"
                                            value="{{ old("medias.{$media->id}.headline", $media->headline) }}"
                                            class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                                             >
                                        @error("medias.{$media->id}.headline")
                                        <p>{{ $message }}</p>
                                        @enderror
                                    </label>
                                    <label class="block" for="{{ $media->id }}_keywords">
                                        <span class="text-gray-700">Keywords</span>
                                        <input
                                            id="{{ $media->id }}_keywords"
                                            type="text"
                                            name="medias[{{ $media->id }}][keywords]"
                                            value="{{ old("medias.{$media->id}.keywords", $media->keywords) }}"
                                            class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                                             >
                                        @error("medias.{$media->id}.keywords")
                                        <p>{{ $message }}</p>
                                        @enderror
                                    </label>
                                </div>
                                <div class="grid grid-cols-1 gap-6 my-8 ">
                                    <label class="block" for="{{ $media->id }}_URL">
                                        <span class="text-gray-700">URL</span>
                                        <select id="{{ $media->id }}_URL" name="medias[{{ $media->id }}][URL] "class="block w-full mt-0 px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black">
                                            @foreach ($urls as $id => $url)
                                                <option
                                                    value="{{ $url['URL'] }}"
                                                    @selected(old("medias.{$media->id}.URL", $media->URL) == $url['URL'])>
                                                    {{ $url['URL'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("medias.{$media->id}.URL")
                                        <p>{{ $message }}</p>
                                        @enderror
                                    </label>
                                </div>
                                <div class="grid grid-cols-1 gap-6">
                                    <label class="block" for="{{ $media->id }}_description">
                                        <span class="text-gray-700">Caption</span>
                                        <textarea
                                            id="{{ $media->id }}_description"
                                            name="medias[{{ $media->id }}][description]"
                                            class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                                            rows="2">{{ old("medias.{$media->id}.description", $media->description) }}</textarea>
                                        @error("medias.{$media->id}.description")
                                        <p>{{ $message }}</p>
                                        @enderror
                                    </label>
                                </div>
                                <div class="grid grid-cols-1 gap-6">
                                    <div class="block">

                                        <div class="mt-2">
                                            <div>
                                                <label class="inline-flex items-center">
                                                    <input
                                                        name="medias[{{ $media->id }}][process]"
                                                        type="checkbox"
                                                        class="border-gray-300 border-2 text-black focus:border-gray-300 focus:ring-white">
                                                    <span class="ml-2">Process</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  @endforeach
                    <div class="p-12 flex items-center justify-end">
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Save
                        </button>
                    </div>

                </form>
                <div>
                    {{ $medias->links() }}
                </div>

</x-admin.layout>
