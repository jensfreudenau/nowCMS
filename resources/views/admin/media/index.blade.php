<x-admin.layout>
    <div x-data="contentLoader()">
        <select x-on:change="fetchContent($event.target.value)">
            <option value="">Bitte auswählen</option>
            @foreach($websites as $website)
                <option value="{{$website}}">{{$website}}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-4 gap-4 p-4 pt-8" id="content">

    </div>

    <script>
        function sel(id) {
            fetch('/set_on_frontsite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({id: id})
            })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error("Fehler:", error));
        }

        function myFunction(value) {
            let checked = '';
            console.log(value);
            if (value.on_frontsite === 1) {
                checked = 'checked';
            }
            let html = '<div class="flex flex-col items-center space-y-2">' +
                '<img src="' + value.url + '" class="w-32 h-32 object-cover rounded-lg shadow-lg">' +
                '<label class="items-center space-x-2 ">' +
                '<input type="checkbox" ' + checked + ' onclick="sel(' + value.id + ')" class="w-5 h-5 text-blue-500 rounded border-gray-300 focus:ring focus:ring-blue-300">' +
                '<span class="text-gray-700">auf der Startseite</span>' +
                '<br><a href="' + value.preview + '">preview</a>' +
                '<br><span class="text-gray-700">' + value.date + '</span>' +
                '</label></div>';
            document.getElementById("content").innerHTML += html;
        }

        function contentLoader() {
            return {
                content: 'Wähle eine Option aus...',
                async fetchContent(id) {
                    if (!id) return;
                    document.getElementById("content").innerHTML = '';
                    let response = await fetch(`/medias/${id}`);
                    if (response.ok) {
                        data = await response.json();
                        let dataResponse = Array.isArray(data) ? data : [data];
                        dataResponse.forEach(function (arrayItem) {
                            for (let key in arrayItem) {
                                if (arrayItem.hasOwnProperty(key)) {
                                    let content = arrayItem[key];
                                    for (let key in content) {
                                        myFunction(content[key]);
                                    }
                                }
                            }
                        });

                    } else {
                        this.content = 'Fehler beim Laden des Inhalts';
                    }
                }
            }
        }
    </script>
</x-admin.layout>
