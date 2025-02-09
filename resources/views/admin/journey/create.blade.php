<x-admin.layout>
    <script src="https://cdn.tiny.cloud/1/enj6vwjkaod8my9vbjwxfphgvru2cmiw98p4fks6xqp9jgpn/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white">
                @if(session('status'))
                    <div class="alert alert-success mb-1 mt-1">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('journey.store') }}" id="editor-form" enctype="multipart/form-data">
                    @csrf
                    @if($message = session()->pull('success'))
                        <p>{{ $message }}</p>
                    @endif
                    <div class="p-12">
                        <label for="name_of_route" class="block">{{ __('Name der Route')}}*</label>
                        <input type="text"
                               name="name_of_route"
                               class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                               id="name_of_route"
                               aria-describedby="name_of_routeHelp"
                               value=""
                               required
                        >
                        <div id="nameHelp" class="text-sm">
                            {{ __('Gib der Route einen Titel. Dieser darf noch nicht von dir verwendet worden sein') }}
                        </div>
                        @error('name_of_route')
                            <div class="invalid-feedback">
                                {{ __('ein gültiger Name der Route ist erforderlich') }}
                            </div>
                        @enderror
                    </div>
                    <div class="px-12">
                        <label for="description" class="block">{{ __('Beschreibung')}}*</label>
                        <textarea
                            name="description"
                            class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                            rows="2"
                            id="description"
                            aria-describedby="descriptionHelp"
                        >
                        </textarea>
                        <div id="descriptionHelp" class="text-sm">
                            {{__('Du kannst hier deine Reise beschreiben. Das Feld ist optional')}}
                        </div>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ __('eine gültige Beschreibung der Route ist erforderlich') }}
                            </div>
                        @enderror
                    </div>
                    <div class="p-12">
                        <label class="block" for="startDate">{{ __('Start Datum') }}</label>
                        <input
                            id="startDate"
                            name="start_date"
                            class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                            type="date"
                        />
                        @error('start_date')
                            <div class="invalid-feedback">
                                {{ __('ein gültiges Start Datum ist erforderlich') }}
                            </div>
                        @enderror
                    </div>
                    <div class="p-12">
                        <input type="checkbox"
                               name="active"
                               id="active"
                               class="rounded"
                            />
                        <label for="active"
                               class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">{{ __('Aktiv')}}
                        </label>
                    </div>
                    <fieldset>
                        <div class="px-12 pt-10">
                            <input type="checkbox"
                                   name="read_from_file"
                                   id="read_from_file"
                                   class="rounded border-1"
                                />
                            <label for="read_from_file" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">{{ __('Koordinaten aus GPX Datei lesen')}}
                            </label>
                        </div>

                    </fieldset>
                    <div class="px-12">
                        <div class="py-12">
                            <div class="block">
                                <label for="gpx">GPX</label>
                                <div class="needsclick dropzone" id="gpx-dropzone">
                                    <div class="dropzone-previews"></div>
                                </div>
                            </div>
                        </div>
                        <div class="py-12">
                            <div class="block">
                                <label for="images">Images</label>
                                <div class="needsclick dropzone" id="images-dropzone">
                                    <div class="dropzone-previews"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="p-12 flex items-center justify-end">
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            {{ __('Speichern') }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @push('js_after')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous"></script>
        <x-forms.dropzone/>
        <x-forms.tinymce-editor/>
    @endpush
</x-admin.layout>

