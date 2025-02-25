<x-admin.layout>

                <div class="p-6 text-gray-900 pl-10">
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <h3 class="font-thin text-xl tracking-tight text-gray-900">{{$jobsInProcess}}&nbsp;{{ __('Jobs in der Queue') }}</h3>
                        </div>
                        <div>
                            @if($jobsInProcess > 0)
                                <a href="{{ route('dispatcher.index') }}">
                                    <button
                                        type="button"
                                        class="float-right relative inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        {{ __('Dispatcher') }}
                                    </button>
                                </a>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('journey.create') }}">
                                <button
                                    type="button"
                                    class="float-right relative inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    {{ __('neue Reise anlegen') }}
                                </button>
                            </a>
                        </div>

                     </div>
                    <div class="grid-cols-1 grid ">
                        <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-black">{{ __('Meine Reisen') }}</h2>
                        <table id="content" class="border-collapse table-auto w-full text-sm my-6 pt-6">
                            <thead>
                            <tr>
                                <th class="text-left">Überschrift</th>
                                <th class="text-left">Adressen aus Breitengraden generieren</th>
                                <th class="text-left">Aktiv</th>
                                <th class="text-left">Edit</th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($journeys as $journey)
                                    <tr>
                                        <td class="border-b border-slate-100 dark:border-slate-700 py-4"><a class="pl-3 fs-4 mr-3" href="{{ URL::to('/') . '/journey/' . $journey->slug }}">{{ $journey->name_of_route }}</a>&nbsp;</td>
                                        <td class="border-b border-slate-100 dark:border-slate-700 py-4">
                                            @if($jobsInProcess === 0)
                                                @if($countGeo[$journey->id] !== 0)
                                                    <a href="#" class="icon generate_geo" data-id="{{ $journey->id }}" data-token="{{ csrf_token() }}" data-journey="{{$journey->slug}}">
                                                        <span id="journey_globe_{{ $journey->id }}" class="">{{$countGeo[$journey->id]}}
                                                            <i class="fa fa-globe" aria-hidden="true"></i> Generate Geo Informations
                                                        </span>
                                                    </a>

                                                @endif
                                            @endif
                                        </td>
                                        <td class="border-b border-slate-100 dark:border-slate-700 py-4">{{ $journey->active }}</td>
                                        <td class="border-b border-slate-100 dark:border-slate-700 py-4">
                                            <a href="{{ route('journey.edit',$journey->slug) }}">
                                            <span class="mb-3 pb-3">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

    <script type="module">
        $('.generate_geo').click(function () {
            let id = $(this).data("id");
            $( '#journey_globe_' + id).hide();
            let token = $(this).data("token");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '/dispatcher/generateGeoInforomations/' + id,
                type: "GET",
                dataType: "JSON",
                data: {
                    "_method": 'GET',
                    "_token": token,
                },
                success: function () {
                    $( '#journey_globe_' + id).show();
                    console.log('success');
                    window.location.href = 'dispatcher/index';
                },
                error: function (xhr) {
                    console.log(xhr.responseText); // this line will save you tons of hours while debugging
                }
            });
        });
    </script>

</x-admin.layout>

