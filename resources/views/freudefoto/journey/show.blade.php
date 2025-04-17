

<x-freudefoto.layout>
    {!! $journey->description !!}
{{--    <x-slot:heading></x-slot:heading>--}}


{{--    @push('js_after')--}}

{{--        <script>--}}

{{--<script type="module">--}}{{--

            readFile('{{$url}}/line.js', setLine);
            readFile('{{$url}}/marker.js', setMarker);

            function setMarker(line_data) {
                let geoJson = createMarkerGeoJson(line_data);

                for (const marker of geoJson.features) {
                    --}}
{{--let iconurl = '{{$url}}' + '/' + marker.properties.icon.iconUrl;--}}{{--

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
                geoJson = createLineGeoJson(lineData);
                console.log(geoJson);
                // document.getElementById('zoomto').addEventListener('click', () => {
                //     // Geographic coordinates of the LineString
                //     const coordinates = geojson.features[0].geometry.coordinates;
                //
                //     // Create a 'LngLatBounds' with both corners at the first coordinate.
                //     const bounds = new mapboxgl.LngLatBounds(
                //         coordinates[0],
                //         coordinates[0]
                //     );
                //
                //     // Extend the 'LngLatBounds' to include every coordinate in the bounds result.
                //     for (const coord of coordinates) {
                //         bounds.extend(coord);
                //     }
                //
                //     map.fitBounds(bounds, {
                //         padding: 20
                //     });
                // });

                // const ne = new mapboxgl.LngLat(-73.9397, 40.8002);
                // const llb = new mapboxgl.LngLatBounds(sw, ne);
                // console.log(geoJson.features.length);
                let coordinates = geoJson.features[0].geometry.coordinates;
                console.log(coordinates);
                const sw = new mapboxgl.LngLat(coordinates[0],coordinates[1]);
                coordinates = geoJson.features[geoJson.features.length - 1].geometry.coordinates;
                const ne = new mapboxgl.LngLat(coordinates[0],coordinates[1]);
                console.log(coordinates);
                // Create a 'LngLatBounds' with both corners at the first coordinate.
                const bounds = new mapboxgl.LngLatBounds(sw, ne);

                // Extend the 'LngLatBounds' to include every coordinate in the bounds result.
                for (const coord of coordinates) {
                    bounds.extend(coord);
                }
                //
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

        </script>
    @endpush
--}}
</x-freudefoto.layout>

