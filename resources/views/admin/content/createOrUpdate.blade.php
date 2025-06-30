@php use Carbon\Carbon; @endphp
<x-admin.layout>


@if (isset($content))
    <form action="{{ route('contents.update', $content) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{ route('contents.store') }}" method="POST" enctype="multipart/form-data">
@endif
@csrf
    <div class="p-12">
        <label for="header" class="block">{{ __('Überschrift')}}*</label>
        <input type="text"
               name="header"
               value="{{ old('header', $content->header ?? '') }}"
               class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
               aria-describedby="headerHelp"
               placeholder="Überschrift">
        <div id="headerHelp" class="text-sm">
            {{ __('Gib dem eine Überschrift.') }}
        </div>
        @error('header')
        <div class="invalid-feedback text-red-500">
            {{ __('eine gültige Überschrift ist erforderlich') }}
        </div>
        @enderror
    </div>
    <div class="px-12">
        <label class="block" for="date">{{ __('Datum') }}</label>
        <input type="date"
               name="date"
               id="date"
               value="{{ old('date', $content->date ?? '') }}"
               class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black">
        @error('date')
        <div class="invalid-feedback text-red-500">
            {{ __('ein gültiges Datum ist erforderlich') }}
        </div>
        @enderror
    </div>
    <div class="p-12">
        <label for="metadescription" class="block">{{ __('Meta Beschreibung')}}</label>
        <input type="text"
               id="metadescription"
               name="metadescription"
               aria-describedby="metadescriptionHelp"
               value="{{ old('metadescription', $content->metadescription ?? '') }}"
               class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black">
        @error('metadescription')
        <div class="invalid-feedback">
            {{ __('eine gültige Meta Beschreibung ist optional') }}
        </div>
        @enderror
    </div>
    <div class="px-12 pb-8">
        <div>
            <select name="website">
                @foreach ($websites as $key => $website)
                    <option value="{{$website->value}}" {{(old('website', $website->value) == $contentWebsite ? 'selected' : '')}} > {{$website->name}} </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="p-12">
        <div>
            <label for="category" class="pr-4">{{ __('Kategorie')}}</label>
            <select id="category" name="category_id" class="border-0">
                @foreach($categories as $key => $category)
                    <option value="{{$key}}"
                            @if(!empty($content))
                        {{(old('category_id', $content->category_id) == $key ? 'selected' : '')}}
                        @endif
                    > {{$category}} </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="px-12">
        <label for="text" class="block">{{ __('Content')}}</label>
        <x-forms.textarea :text="old('text', $content->text ?? '')" name="text" id="contentText"/>
        [![An old rock in the desert](/assets/images/shiprock.jpg "Shiprock, New Mexico by Beau Rogers")](https://www.flickr.com/photos/beaurogers/31833779864/in/photolist)
    </div>
    <fieldset>
        <div class="px-12 pt-10">
            <input type="checkbox"
                   name="single"
                   id="single"
                   class="rounded"
                @checked(old('single', $content->single ?? '')) />
            <label for="single"
                   class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">{{ __('Einzelseite')}}
            </label>
        </div>
        <div class="px-12 pt-10">
            <input type="checkbox"
                   name="is_text"
                   id="is_text"
                   class="rounded"
                @checked(old('is_text', $content->is_text ?? '')) />
            <label for="is_text"
                   class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">{{ __('Text Content')}}
            </label>
        </div>
        <div class="p-12">
            <input type="checkbox"
                   name="active"
                   id="active"
                   class="rounded"
                @checked(old('active', $content->active ?? '')) />
            <label for="active"
                   class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">{{ __('Aktiv')}}
            </label>
        </div>
    </fieldset>
    <div class="px-12">
        <label class="block" for="gpx">Upload, bei Fotos nur jpeg</label>
        <div class="needsclick dropzone" id="uploadContent">
            <div class="dropzone-previews"></div>
        </div>
    </div>
    <div class="px-12 pt-10">
        <label for="tags" class="block">{{ __('Tags')}}</label>
        <input type="text"
               value="{{ old('tags', $tags ?? '') }}"
               id="tags"
               name="tags"
               class="tagify mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
               autofocus>
    </div>
    <div class="p-12 flex items-center justify-end">
        <x-primary-button>{{ __('speichern')}}</x-primary-button>
    </div>
</form>
@if (isset($content))
    <div class="px-12">
        @php $mediaItemsAll = $content->getMedia('images'); @endphp
        <ul class="text-gray-500 list-none list-inside dark:text-black" id="imageFiles">
            @foreach( $mediaItemsAll->all() as $key => $mediaItems)
                <li class="flex border-2 py-4 mb-2 pb-3" data-media-id="{{$mediaItems->id}}"
                    id="list_{{$mediaItems->id}}" data-id="{{$mediaItems->id}}">
                    <div class="flex w-1/2 flex-wrap admin"
                         id="image_list_{{$mediaItems->id}}">
                        <div class="p-1 md:p-2">
                            <img
                                alt="{{$mediaItems->meta}}"
                                class=""
                                id="list_{{$mediaItems->id}}"
                                data-media-id="{{$mediaItems->id}}"
                                src="{{$mediaItems->getUrl()}}"/>
                            <div class="overlay">
                                <a class="icon button_delete_media"
                                   title="delete image {{$mediaItems->meta}} / {{$mediaItems->id}}"
                                   data-id="{{ $mediaItems->id }}"
                                   data-token="{{ csrf_token() }}"
                                   data-content="{{$content->slug}}"
                                   data-type="images">
                                    <i class="fa-regular fa-trash-can hover:text-red-900 text-red-700"></i>
                                </a>
                            </div>
                            <span class="text-sm font-thin">{{ Carbon::parse($mediaItems->date)->format('d.m.Y')}}</span>
                        </div>
                    </div>
                </li>
        @endforeach
        </div>
        </form>

    @endif


        @push('js_after')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"
                    integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w=="
                    crossorigin="anonymous">
            </script>


            <script type="module">
                let tagslist = '';
                let input = document.querySelector('input[name="tags"]');
                $(function () {
                    $.ajax({
                        'url': '/admintags/tags',
                        'success': function (data) {
                            tagslist = data;
                            new Tagify(input, {
                                whitelist: tagslist.data,
                                dropdown: {
                                    classname: "color-blue",
                                    enabled: 1,              // show the dropdown immediately on focus
                                    maxItems: 15,
                                    // position      : "text",         // place the dropdown near the typed text
                                    closeOnSelect: close,          // keep the dropdown open after selecting a suggestion
                                    highlightFirst: true,
                                    duplicates: false,
                                }
                            })
                        }
                    });
                })

                let el = document.getElementById('imageFiles');
                const sluggy = window.location.href.split('/');
                let sortable = Sortable.create(el, {
                    animation: 150,
                    onChange: function (/**Event*/evt) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "/journey/updateMedia",
                            data: {order: sortable.toArray(), slug: sluggy[4]},
                            dataType: 'json',
                            success: function () {
                                console.log('success');
                            },
                            error: function (data) {
                                console.log(data);
                            }
                        });
                    }
                });
                const uploadedImagesMap = {};
                const uploadedContent = {};

                Dropzone.options.uploadContent = {
                    maxFilesize: 22, // MB
                    url: '{{route('contents.storeMedia')}}',
                    addRemoveLinks: true,
                    // acceptedFiles: 'application/xml',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (file, response) {
                        $('form').append('<input type="hidden" name="upload[]" value="' + response.name + '">')
                        uploadedContent[file.name] = response.name
                    },
                    removedfile: function (file) {
                        file.previewElement.remove()
                        let name = '';
                        if (typeof file.file_name !== 'undefined') {
                            name = file.file_name
                        } else {
                            name = uploadedContent[file.name]
                        }
                        $('form').find('input[name="upload[]"][value="' + name + '"]').remove()
                    },
                    init: function () {
                        @if(isset($content) && $content->upload)
                        const files = {!! json_encode($content->upload) !!}

                        for(const i in files)
                        {
                            const file = files[i];
                            this.options.addedfile.call(this, file)
                            file.previewElement.classList.add('dz-complete')
                            $('form').append('<input type="hidden" name="upload[]" value="' + file.file_name + '">')
                        }
                        @endif
                    }
                }
                $('.button_delete_media').click(function () {
                    let id = $(this).data("id");
                    let token = $(this).data("token");
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: '/contents/deleteMedia/' + id,
                        type: "DELETE",
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "slug": $(this).data('content'),
                            "type": $(this).data('type'),
                            "_method": 'DELETE',
                            "_token": token,
                        },
                        success: function () {
                            $('#list_' + id).hide();
                            $('#image_list_' + id).hide();
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        }
                    });
                });
            </script>

    @endpush
</x-admin.layout>
