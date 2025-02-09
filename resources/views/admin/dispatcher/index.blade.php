<x-admin.layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden">
                <div class="p-6 text-gray-900 pl-10">
                    <div id="display-content"></div>
                    <p class="pb-11">
                        {{ __('current Jobs') }} (<span id="queuedJobs" >{{$queuedJobs}}</span>)
                        <button
                            type="button"
                            id="button_start_jobs"
                            class="float-right relative inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            {{__('Jobs starten') }}
                        </button>
                    <table class="border-collapse table-auto w-full text-sm my-6 pt-6">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Queue</th>
                                <th>Attempts</th>
{{--                                <th>Payload</th>--}}
                                <th>Reserved At</th>
                                <th>Available At</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td class="align-top align-text-top">{{$job->id}}</td>
                                    <td>{{$job->queue}}</td>
                                    <td>{{$job->attempts}}</td>
{{--                                    <td>{{$job->payload}}</td>--}}
                                    <td>
                                        {{ Carbon\Carbon::parse($job->reserved_at)->format('d.m.Y H:i') }}
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($job->available_at)->format('d.m.Y H:i') }}
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($job->created_at)->format('d.m.Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>

                <div class="p-6 text-gray-900 pl-10">
                    <p class="pb-11">
                        {{ __('failed Jobs') }}(<span id="failedJobs" >{{$failedRunningJobs}}</span>)
                        <button
                            type="button"
                            id="button_delete_jobs"
                            class="button_retry_jobs float-right relative inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            {{__('abgebrochene Jobs löschen') }}
                        </button>
                        <button
                            type="button"
                            id="button_restart_jobs"
                            class="button_retry_jobs float-right relative inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            {{__('abgebrochene Jobs neu starten') }}
                        </button>
                    </p>
                    <table class="border-collapse table-auto w-full text-sm my-6 pt-6">
                            <thead class="">
                            <tr>
                                <th>id</th>
                                <th>UUID</th>
                                <th>Queue</th>
                                <th>Exception</th>
                                <th>Failed At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($failedJobs as $failedJob)
                                <tr>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 align-top">{{$failedJob->id}}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 align-top">{{$failedJob->uuid}}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 align-top">{{$failedJob->queue}}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 align-top">
                                        {!! Str::words("$failedJob->exception", 10, ' ...') !!}
                                       </td>
                                    <td class="align-top">
                                        {{ Carbon\Carbon::parse($failedJob->failed_at)->format('d.m.Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
<script type="module">
    jQuery('#button_start_jobs').on("click", function (evt) {
        sendRequest();
        evt.preventDefault();
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: 'startQueue',
            type: "GET",
            cache: false,
            contentType: 'application/json; charset=utf-8',
            processData: false,
            success: function (response)
            {
                console.log(response);
                jQuery("#display-content").load().fadeIn("fast");
                alert('New message received');
            }
        });
    });
    jQuery('.button_retry_jobs').on("click", function (evt) {
        sendFailedRequest();
        evt.preventDefault();
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: 'retryFailedJobs',
            type: "GET",
            cache: false,
            contentType: 'application/json; charset=utf-8',
            processData: false,
            success: function (response)
            {
                console.log(response);
                jQuery("#display-content").load().fadeIn("fast");
                alert('New message received');
            }
        });
    });
    jQuery('#button_delete_jobs').on("click", function (evt) {
        evt.preventDefault();
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: 'deleteFailedJobs',
            type: "GET",
            cache: false,
            contentType: 'application/json; charset=utf-8',
            processData: false,
            success: function (response)
            {
                console.log(response);
                location.reload();
            }
        });
    });
    function sendRequest(){
        $.ajax({
            url: "countQueuedJobs",
            success:
                function(result){
                    $('#queuedJobs').text(result.queuedJobs); //insert text of test.php into your div
                    setTimeout(function(){
                        sendRequest(); //this will send request again and again;
                    }, 5000);
                }
        });
    }
    function sendFailedRequest(){
        $.ajax({
            url: "countFailedJobs",
            success:
                function(result){
                    $('#failedJobs').text(result.failedJobs); //insert text of test.php into your div
                    setTimeout(function(){
                        sendRequest(); //this will send request again and again;
                    }, 5000);
                }
        });
    }
</script>

</x-admin.layout>
