<x-admin.layout>


                <div class="p-6 text-gray-900 pl-10">
                    <p class="pb-11">
                        <x-button-new href="/contents/create">{{__('Neuer Content')}}</x-button-new>
                    </p>
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                        <div id="dataTable_length"></div>
                        <table id="content" class="border-collapse table-auto w-full text-sm my-6 pt-6">
                            <thead>
                            <tr>
                                <th class="text-left">Datum</th>
                                <th class="text-left">Überschrift</th>
                                <th class="text-left">Webseite</th>
                                <th class="text-left">Kategorie</th>
                                <th class="text-left">Aktiv</th>
                                <th class="text-left">Single</th>
                                <th class="no-sort"></th>
                                <th class="no-sort"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contents as $content)
                                <tr>
                                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">{{$content->date}}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">
                                       <span> {{$content->header}}
                                        <a href="https://{{$content->website}}/single/{{$content->slug}}"
                                           target="_blank"><i class="fas fa-external-link-alt"></i></a></span>
                                        </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">{{$content->website}}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">
                                        @if($content->category)
                                            {{$content->category['name']}}
                                        @endif
                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">{{$content->active}}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">{{$content->single}}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">
                                        <x-button-new href="{{ route('contents.update', $content->id) }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </x-button-new>
                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 py-4">
                                        <div class="flex justify-end">
                                            <form method="POST" action="{{ route('contents.destroy', $content) }}"
                                                  onsubmit="return confirm('Are you sure:');">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                        class="right-0 rounded-md bg-red-300 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


    @push('js_after')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
        <script type="module">
            $(function() {
                $('#content').DataTable({
                    columnDefs: [
                        {
                            target: 0, /* index of column, starting at 0 */
                            render: DataTable.render.date()
                        },
                        {
                            orderable: false,
                            targets: "no-sort"
                        }
                    ],
                    pageLength: 25,
                    language: languageDE,
                    order: [[0, 'desc']],
                    initComplete: function () {
                        this.api().columns([2]).every( function () {
                            let column = this;
                            let select = $('<select><option value=""></option></select>')
                                .appendTo( $(column.header()).empty() )
                                .on( 'change', function () {
                                    let val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );
                    }
                } );
            } );
        </script>
    @endpush
</x-admin.layout>
