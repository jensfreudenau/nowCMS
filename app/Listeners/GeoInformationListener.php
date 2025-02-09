<?php

namespace App\Listeners;

use App\Events\GeoInformation;
use App\Services\GeoService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection as ModelMediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GeoInformationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @param GeoService $geoService
     */
    public function __construct(public GeoService $geoService)
    {
        Log::debug('GeoInformationListener startet');
    }

    /**
     * Handle the event.
     *
     * @param GeoInformation $event
     * @return void
     */
    public function handle(GeoInformation $event): void
    {
        Log::debug('start handle GeoInformationListener');
        if ($event->journey->hasMedia('gpx')) {
            $gpxFileMedia = $event->journey->getMedia('gpx')->sortBy('order_column');
            if ($gpxFileMedia->count() > 0) {
                $this->geoService->doGPXOperations(gpxFileMedia: $gpxFileMedia);
            }
        }

        if ($event->journey->hasMedia('images')) {
            $imageFileMedia = $event->journey->getMedia('images');
            $img = $imageFileMedia->first();
            Log::debug($img->getPath());
            if ($imageFileMedia->count() > 0) {
                $this->geoService->doGeoImageOperations(imageFileMedia: $imageFileMedia, event: $event);
            }
        }

    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\GeoInformation  $event
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(GeoInformation $event, $exception): void
    {
        Log::error(json_encode($event));
        Log::error($exception->getMessage());
        Log::error($exception->getTraceAsString());
        Log::error('event failed');
    }
}
