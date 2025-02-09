<?php

namespace App\Http\Controllers;

use App\Events\GeoInformation;
use App\Models\Journey;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\StreamOutput;


class DispatcherController extends BaseController
{

    protected Builder $jobs;
    protected Builder $failedJobs;

    public function __construct()
    {
//        $this->middleware('auth');

        $this->jobs = DB::table('jobs');
        $this->failedJobs = DB::table('failed_jobs');
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $jobs = $this->jobs->get();
        $failedJobs = $this->failedJobs->get();
        $queuedJobs = $this->jobs->count();
        $failedRunningJobs = $this->failedJobs->count();
        return view('/admin/dispatcher.index', compact( 'jobs', 'failedJobs', 'failedRunningJobs', 'queuedJobs'));
    }

    /**
     * @return JsonResponse
     */
    public function countQueuedJobs(): JsonResponse
    {
        $queuedJobs = $this->jobs->count();
        return response()->json([
            'queuedJobs' => $queuedJobs
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function countFailedJobs(): JsonResponse
    {
        $failedJobs = $this->failedJobs->count();
        return response()->json([
            'failedJobs' => $failedJobs
        ]);
    }

    /**
     * @param Journey $journey
     * @return JsonResponse
     */
    public function startQueue( Journey $journey): JsonResponse
    {
        Artisan::call('queue:work --stop-when-empty --timeout=130');
        return response()->json([
            'success' => true,
            'message' => 'No new medias!'
        ]);
    }

    public function retryFailedJobs(): void
    {
        $stream = fopen("php://output", "w");
        Artisan::call('app:queue-retry-failed-jobs', [], new StreamOutput($stream));
        Artisan::call('queue:work --stop-when-empty --timeout=130', [], new StreamOutput($stream));
        $callResponse = ob_get_clean();
        log::debug(print_r($callResponse, true));
    }

    public function deleteFailedJobs(): JsonResponse
    {
        $this->failedJobs->truncate();
        return response()->json([
            'success' => true,
        ]);
    }
    public function showJobs(): void
    {
        $users = DB::table('jobs')->get();
    }

    /**
     * @param Journey $journey
     * @param $id
     * @return JsonResponse
     */
    public function generateGeoInforomations(Journey $journey, $id): JsonResponse
    {
        $journey = new Journey();
        $journeyModel = $journey->find($id);
        GeoInformation::dispatch($journeyModel);

        return response()->json([
            'success' => true,
        ]);
    }
}
