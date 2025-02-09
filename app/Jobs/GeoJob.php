<?php

namespace App\Jobs;

use App\Events\GeoInformation;
use App\Models\Journey;
use App\Services\GeoService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class GeoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;
    use IsMonitored;
    protected Journey $journey;

    public int $tries = 5;

    public int $timeout = 120;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Journey $journey)
    {
        $this->journey = $journey;
    }

    /**
     * Execute the job.
     *
     * @param GeoService $geoService
     * @return void
     */
    public function handle(GeoService $geoService): void
    {
        $media = $this->journey->getMedia('images')->sortBy('order_column');
        $event = new GeoInformation($this->journey);
        $geoService->doGeoImageOperations($media, $event);
    }
}
