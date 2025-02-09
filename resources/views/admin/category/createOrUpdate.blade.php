<x-admin.layout>
    <x-slot:heading></x-slot:heading>
    <x-slot:meta>Jens' Reiseberichte mit dem Rennrad durch Westeuropa</x-slot:meta>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategorie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white">
                @if(session('status'))
                <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
                 <span class="font-medium">{{ session('status') }}
                </div>
                @endif

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden">
                            <div class="p-6 text-gray-900 pl-10">
                                <div class="grid grid-cols-1 gap-4">
                                    <h2>Kategorie</h2>
                                    @if (isset($category))
                                    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                    @endif
                                         @csrf

                                         <div class="p-12">
                                                <label for="de_name" class="required block">{{ __('dt. Name')}}*</label>
                                                <input type="text"
                                                       name="de_name"
                                                       value="{{ old('de_name', $category?->translate('de')->name ?? '') }}"
                                                       class="{{ $errors->has('de_name') ? 'is-invalid' : '' }} mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                                                       aria-describedby="nameHelp"
                                                       id="de_name"
                                                       placeholder="Name"
                                                       required>
                                                <div id="nameHelp" class="text-sm">
                                                    {{ __('Gib dem einen Namen') }}.
                                                </div>
                                                @error('name')

                                                <div class="invalid-feedback">
                                                    {{ __('ein gültiger Name ist erforderlich') }}
                                                </div>
                                                @enderror
                                         </div>
                                             <div class="p-12">
                                             <label for="en_name" class="required block">{{ __('engl. Name')}}*</label>
                                             <input type="text"
                                                    name="en_name"
                                                    id="en_name"
                                                    value="{{ old('en_name', $category?->translate('en')->name ?? '') }}"
                                                    class="form-control
                                                        {{ $errors->has('en_name') ? 'is-invalid' : '' }} mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                                                    aria-describedby="nameHelp"
                                                    placeholder="Name"
                                                    required>
                                             <div id="nameHelp" class="text-sm">
                                                 {{ __('Gib dem einen engl. Namen') }}.
                                             </div>
                                             @error('name')

                                             <div class="invalid-feedback">
                                                 {{ __('ein gültiger Name ist erforderlich') }}
                                             </div>
                                             @enderror
                                        </div>
                                        <div class="p-12 flex items-center justify-end">
                                            <x-link  href="/categories/list">zurück</x-link>
                                            <button type="submit"
                                                    class="
                                                    rounded-md
                                                    bg-indigo-600
                                                    px-3
                                                    py-2
                                                    text-sm
                                                    font-semibold
                                                    text-white
                                                    shadow-sm
                                                    hover:bg-indigo-500
                                                    focus-visible:outline
                                                    focus-visible:outline-2
                                                    focus-visible:outline-offset-2
                                                    focus-visible:outline-indigo-600"
                                            >
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                    @if (isset($category))
                                    <div class="flex justify-end">

                                        <form method="POST" action="{{ route('category.destroy', $category) }}" onsubmit="return confirm('Are you sure');">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="right-0 rounded-md bg-red-300 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                                @if (isset($category))
                                <div class="grid grid-cols-1 gap-4">
                                    <ul>
                                    @foreach($contents as $content)
                                        <li>
                                            {{$content->header}}
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js_after')
        <script type="module">
            let $englishForm = $('#english-form');
            let $germanForm = $('#german-form');
            let $englishLink = $('#english-link');
            let $germanLink = $('#german-link');

            $englishLink.click(function() {
                $englishLink.toggleClass('bg-aqua-active');
                $englishForm.toggleClass('hidden');
                $germanLink.toggleClass('bg-aqua-active');
                $germanForm.toggleClass('hidden');
            });

            $germanLink.click(function() {
                $englishLink.toggleClass('bg-aqua-active');
                $englishForm.toggleClass('hidden');
                $germanLink.toggleClass('bg-aqua-active');
                $germanForm.toggleClass('hidden');
            });
        </script>
    @endpush
</x-admin.layout>
