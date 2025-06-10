<x-admin.layout>
    <h2 class="text-3xl m-4 p-4 pt-1 mt-1">Tag List</h2>
    <div  class="m-4 p-4" x-data="{ tags: {{$tags}} }">
        <ul class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <template x-for="tag in tags" :key="tag.id">
                <li class="bg-white p-4 rounded shadow">
                    <div x-data="{ editing: false, newName: tag.name }" class="tag">
                        <span x-show="!editing" x-text="tag.name" @click="editing = true"></span>
                        <input x-show="editing" x-model="newName" @keydown.enter="saveTag(tag.id, newName)"
                               @blur="editing = false">
                    </div>
                </li>
            </template>
        </ul>
    </div>

    <script>
        function saveTag(id, name) {
            fetch(`/admintags/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({name})
            }).then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Fehler beim Speichern');
            }).then(data => {
                if (data.success) {
                    location.reload();
                }
            }).catch(error => console.error(error));
        }

    </script>
</x-admin.layout>
