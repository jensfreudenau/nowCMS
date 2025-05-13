@php use Illuminate\Support\Str; @endphp
<x-admin.layout>
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js"></script>

    <style>
        div.relative {
            position: relative;
            width: 100%;
            height: 800px;
        }

        div#map {
            position: absolute;
            top: 0;
            width: 100%;
            left: 0;
            height: 100%;
        }
    </style>

    @if(session('status'))
        <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
            <span class="font-medium">{{ session('status') }}
        </div>
    @endif

<div class="p-6 text-gray-900 pl-10">
    <div class="grid grid-cols-2 gap-4">
        <div class="pt-2">
            <a href="{{ route('dispatcher.index') }}">{{ __('Job Übersicht') }}</a>
        </div>
        <div class="flex  justify-end">
            <form method="POST" action="{{ route('journey.destroy', $journey->slug) }}" onsubmit="return confirm('are yo sure');">
                @method('DELETE')
                @csrf
                <button type="submit" class="right-0 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ __('löschen') }}
                </button>
            </form>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4">
        <form method="POST" class="needs-validation" novalidate action="{{ route('journey.update', $journey) }}"  enctype="multipart/form-data">
            @method('PUT')
                @csrf
            <div class="p-12">
                <label for="name_of_route" class="block">{{ __('Name der Route') }}*</label>
                <input
                    type="text"
                    name="name_of_route"
                    class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black"
                    id="name_of_route"
                    aria-describedby="nameHelp"
                    value="{{$journey['name_of_route']}}"
                    required
                />
                <div id="nameHelp" class="text-sm">
                    {{ __('Gib der Route einen Titel. Dieser darf noch nicht von dir verwendet worden sein') }}
                </div>
                @error('name_of_route')
                <div class="invalid-feedback"> {{ __('ein gültiger Name ist erforderlich') }} </div>
                @enderror
            </div>
            <div class="px-12">
                <label for="description" class="block">{{ __('Beschreibung')}}</label>
                <x-forms.textarea :text="$journey->description" name="description" id="description"/>
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
                    value="{{$journey['start_date']}}"/>
            </div>
            <div class="p-12">
                <input type="checkbox"
                       name="active"
                       id="active"
                       class="rounded"
                    @checked(old('active', $journey->active ?? '')) />
                <label for="active"
                       class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">{{ __('Aktiv')}}
                </label>
            </div>
            <div class="px-12">
                <label class="block" for="gpx">GPX</label>
                <div class="needsclick dropzone" id="gpxDropzone">
                    <div class="dropzone-previews"></div>
                </div>
            </div>
            <div class="p-12">
                <label class="block" for="images">Images</label>
                <div class="needsclick dropzone" id="imagesDropzone">
                    <div class="dropzone-previews"></div>
                </div>
            </div>
            <div class="mb-3">
                <button
                    type="submit"
                    class="float-right relative inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    {{ __('Speichern') }}
                </button>
                <input type="hidden" name="id" value="{{$journey->id}}">

            </div>

            <div class="p-12">
                <div class="relative">
                    <div id="map"></div>
                </div>
            </div>
            <div class="p-12">
                <h4>GPX Dateien sortieren</h4>
                <ul class="text-gray-500 list-none list-inside dark:text-black" id="gpxFiles">
                @foreach ($mediaGpx as $key => $gpx)
                    <li class="flex border-2 py-4 mb-2 pb-3" data-media-id="{{$gpx->id}}" id="list_{{$gpx->id}}" data-id="{{$gpx->id}}">
                        <i class="px-2 fa-solid fa-hand"></i>
                        <div class="px-5">{{ Carbon\Carbon::parse($gpx->getCustomProperty('start_time'))->setTimezone('Europe/Berlin')->format('d.m.Y H:i:s') }} </div>
                        <div class="px-3">
                              {{Str::after($gpx->file_name, '_')}}
                        </div>
                        <button
                            type="button"
                            data-id="{{ $gpx->id }}"
                            id="{{$gpx->id}}"
                            data-token="{{ csrf_token() }}"
                            data-journey="{{$journey->slug}}"
                            data-type="gpx"
                            class="button_delete_media px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            {{ __('löschen') }}
                        </button>
                    </li>
                @endforeach
                </ul>
            </div>
            <div class="p-12">
                <div class="grid grid-cols-4 gap-4 p-4 pt-8" id="">
                    @foreach ($mediaImages as $mediaImage)
                    <div class="" id="image_list_{{$mediaImage->id}}">
                       <img alt="" class="figure-img img-fluid rounded float-md-left" src="{{ $mediaImage->getUrl('thumb_square') }}">
                        <div class="overlay">
                            {{$mediaImage->getCustomProperty('DateTimeOriginal')}}
                            <a class="button_delete_media" title="delete image" data-id="{{ $mediaImage->id }}" data-token="{{ csrf_token() }}" data-journey="{{$journey->slug}}" data-type="images">
                                <i class="fa fa-minus-square"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
</div>


@push('js_after')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous"></script>
    <script type="module">

        readFile('{{$url}}/line.js', setLine);
        readFile('{{$url}}/marker.js', setMarker);

        function setMarker(line_data) {
            let geoJson = createMarkerGeoJson(line_data);

            for (const marker of geoJson.features) {
                let iconurl = '{{$url}}' + '/' + marker.properties.icon.iconUrl;
                let el = document.createElement('div');
                let width = marker.properties.icon.iconSize[0];
                let height = marker.properties.icon.iconSize[1];
                let img = document.createElement('img');
                img.src = iconurl;
                img.style.height = '40px';
                img.style.width = '40px';

                el.appendChild(img);
                el.style.width = '40px';
                el.dragable = true;
                new mapboxgl.Marker(el)
                    .setLngLat(marker.geometry.coordinates)
                    .setPopup(
                        new mapboxgl.Popup({offset: 25, maxWidth: '460px'}) // add popups
                            .setHTML(
                                `<img width=300px" src=${'{{$url}}' + '/' + marker.properties.images} />
                                <p>${marker.properties.description} <br />${marker.properties.date}</p>`
                            )
                    )
                    .addTo(map);
            }
        }

        function setLine(data) {
            map.on('load', () => {
                map.addSource('route', {
                    'type': 'geojson',
                    'data': {
                        'type': 'Feature',
                        'properties': {},
                        'geometry': {
                            'type': 'LineString',
                            'coordinates': data
                        }
                    }
                });
                map.addLayer({
                    'id': 'route',
                    'type': 'line',
                    'source': 'route',
                    'layout': {
                        'line-join': 'round',
                        'line-cap': 'round'
                    },
                    'paint': {
                        'line-color': 'darkblue',
                        'line-width': 2
                    }
                });
            });
            centerMap(data);
        }

        /**
         * @param lineData
         */
        function centerMap(lineData) {
            let geoJson = createLineGeoJson(lineData);
            let coordinates = geoJson.features[0].geometry.coordinates;
            const sw = new mapboxgl.LngLat(coordinates[0],coordinates[1]);
            coordinates = geoJson.features[geoJson.features.length - 1].geometry.coordinates;
            const ne = new mapboxgl.LngLat(coordinates[0],coordinates[1]);
            const bounds = new mapboxgl.LngLatBounds(sw, ne);
            for (const coord of coordinates) {
                bounds.extend(coord);
            }
            map.fitBounds(bounds, {
                padding: 20
            });
        }

        function createLineGeoJson(line_data) {
            let line = '';
            for (let j = 0; j < line_data.length; j++) {
                line += '{' +
                    '"type": "Feature", ' +
                    '"geometry": ' +
                    '{' +
                    '"type":"Point",' +
                    '"coordinates": ["' + line_data[j][0] + '", "' + line_data[j][1] + '"]' +
                    '}' +
                    '},';
            }
            let jsonLine = '[' + line.slice(0, -1);
            jsonLine += ']';
            return {
                type: 'FeatureCollection',
                features: JSON.parse(jsonLine)
            };
        }

        function createMarkerGeoJson(line_data) {
            let marker = '';
            for (let j = 0; j < line_data.length; j++) {
                marker += '{' +
                    '"type": "Feature", ' +
                    '"geometry": ' +
                    '{' +
                    '"type":"Point",' +
                    '"coordinates": ["' + line_data[j]['lon'] + '", "' + line_data[j]['lat'] + '"]' +
                    '},' +
                    '"properties": ' +
                    '{' +
                    '"id": "' + line_data[j]['picture'] + '",' +
                    '"title": "' + line_data[j]['picture'] + '",' +
                    '"date": "' + line_data[j]['DateTimeOriginal'] + '",' +
                    '"description": "' + line_data[j]['Address'] + '",' +
                    '"iconSize": [30, 30], ' +
                    '"icon": {' +
                    '"iconUrl": "conversions/' + line_data[j]['thumb'] + '",' +
                    '"iconSize": [10, 10], ' +
                    '"iconAnchor": [7, 7], ' +
                    '"popupAnchor": [0, -25], ' +
                    '"className": "dot"' +
                    '},' +
                    '"images": "conversions/' + line_data[j]['preview'] + '",' +
                    '"draggable": "true"}' +
                    '},';
            }
            let jsonMarker = '[' + marker.slice(0, -1);
            jsonMarker += ']';
            return {
                type: 'FeatureCollection',
                features: JSON.parse(jsonMarker)
            };
        }

        function readFile(file, callback) {
            fetch(file)
                .then(
                    function (response) {
                        if (response.status !== 200) {
                            console.log('Looks like there was a problem. Status Code: ' +
                                response.status);
                            return;
                        }
                        // Examine the text in the response
                        response.json().then(function (data) {
                            callback(data);
                        });
                    }
                )
                .catch(function (err) {
                    console.log('Fetch Error :-S', err);
                });

        }

        mapboxgl.accessToken = 'pk.eyJ1IjoiamVuc2YiLCJhIjoiY2wyMHBubnUzMDRlNDNibXFnbXowZzlvMSJ9.q9BH4_0cwLZL3rO7RDqCuA';
        const map = new mapboxgl.Map({
            container: 'map',
            // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
            //style: 'mapbox://styles/jensf/cl9wzx3ao002t16ocvkbszdpu',
            style: 'mapbox://styles/jensf/cl9wzx3ao002t16ocvkbszdpu',
            // center: [+4.812336, +45.264867],
            zoom: 5
        });



    let el = document.getElementById('gpxFiles');
    const sluggy = window.location.href.split('/');
    let sortable = Sortable.create(el, {
        animation: 150,
        onChange: function(/**Event*/evt) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url:"/journey/updateMedia",
                data: {order:sortable.toArray(), slug:sluggy[4]},
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
        $('.button_delete_media').click(function(){
            let id = $(this).data("id");
            let token = $(this).data("token");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '/journey/deleteMedia/' + id,
                type: "DELETE",
                dataType: "JSON",
                data: {
                    "id": id,
                    "slug": $(this).data('journey'),
                    "type": $(this).data('type'),
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function ()
                {
                    $( '#list_' + id).hide();
                    $( '#image_list_' + id).hide();
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // this line will save you tons of hours while debugging
                }
            });
        });
    </script>
        <x-forms.dropzone/>
        <x-forms.tinymce-editor/>
    @endpush
</x-admin.layout>
