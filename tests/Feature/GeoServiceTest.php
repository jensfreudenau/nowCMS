<?php

namespace Tests\Feature;

use App\Events\GeoInformation;
use App\Listeners\GeoInformationListener;
use App\Models\Journey;
use App\Services\GeoService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class GeoServiceTest extends TestCase
{
    public function test_event_geoservice()
    {
        Event::fake();
        Event::assertListening(
            expectedEvent: GeoInformation::class,
            expectedListener: GeoInformationListener::class,
        );
    }

    public function test_the_geoservice_exiftool_find_gps(): void
    {
        $journey = Journey::find(11);
        $event = new GeoInformation($journey);
        $geoService = new GeoService();
        $imageFileMedia = $event->journey->getMedia('images');
        $geoService->setPath(dirname($imageFileMedia->first()->getPath()));
        $gpx = $event->journey->getMedia('gpx');
        foreach ($imageFileMedia as $media) {
            $returnString = $geoService->readCoordinatesFromGPXFile($gpx, $media);
            $this->assertStringContainsString('1 image files', $returnString);
        }
    }

    public function test_doGeoImageOperationsWithGPS()
    {
        $journey = Journey::find(11);
        $event = new GeoInformation($journey);
        $geoService = new GeoService();
        $imageFileMedia = $event->journey->getMedia('images');
        $geoService->doGeoImageOperations($imageFileMedia, $event);
        $this->assertTrue($imageFileMedia[0]->hasCustomProperty('lat'));
    }

    public function test_writeMarkerFile()
    {
        $journey = Journey::find(11);
        $event = new GeoInformation($journey);
        $geoService = new GeoService();
        $imageFileMedia = $event->journey->getMedia('images');
        $geoService->setPath(dirname($imageFileMedia->first()->getPath()));
        $geoService->writeMarkerFile($imageFileMedia);
        $path = dirname($imageFileMedia->first()->getPath());
        $this->assertFileExists($path . '/marker.js');
        $json = File::get($path . '/marker.js');
        $decoded = json_decode($json, true);
        $this->assertSame('+45.060170', $decoded[0]['lat']);
    }

    public function test_doGeoImageOperationsWitOutGPS()
    {
        $journey = Journey::find(10);
        $event = new GeoInformation($journey);
        $geoService = new GeoService();
        $imageFileMedia = $event->journey->getMedia('images');
        if (file_exists($imageFileMedia->first()->getPath() . '_original')) {
            File::Delete($imageFileMedia->first()->getPath());
            File::Move($imageFileMedia->first()->getPath() . '_original', $imageFileMedia->first()->getPath());
        }
        $geoService->doGeoImageOperations($imageFileMedia, $event);
        $this->assertTrue($imageFileMedia[0]->hasCustomProperty('lat'));
    }

    public function test_MediaSave()
    {
        $mediaItem = Media::find(32);
        $mediaItem->setCustomProperty('long', 1236);
        $mediaItem->save();
        $mediaItem2 = Media::find(32);
        $this->assertTrue($mediaItem2->hasCustomProperty('long'));
        $this->assertSame(1236, $mediaItem2->getCustomProperty('long'));
    }
}
