<?php

namespace App\Services;

use App\Events\GeoInformation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;
use SimpleXMLElement;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection as ModelMediaCollection;
use Throwable;

class GeoService
{
    protected const string MARKER_FILE = 'marker.js';
    protected const string LINE_FILE = 'line.js';
    protected const string START = '[';
    protected const string END = ']';
    protected array $image = [
        'GPSLatitude' => '',
        'GPSLongitude' => '',
        'DateTimeOriginal' => '',
    ];
    protected array $coordinatesCollection = [];
    protected string $address = '';
    protected string $path;
    protected $fileHandle;
    /**
     * @var true
     */
    private bool $gpsLatitude = false;
    /**
     * @var true
     */
    private bool $gpsLongitude = false;

    /**
     * @param string $filename
     * @return bool
     */
    private function readExifs(string $filename): bool
    {
//        if (shell_exec('which ' . env('EXIF_TOOL_PATH')) === null) {
//            Log::debug('no exiftool');
//            return false;
//        }
        $this->gpsLatitude = false;
        $this->gpsLongitude = false;
        $array = shell_exec(
            config(
                'app.exif_tool_path'
            ) . ' -c "%+8f" -EXIF:GPS -GPSLatitude -GPSLongitude -DateTimeOriginal -json ' . $filename
        );
        $data = json_decode($array);
        try {
            if (is_object($data[0])) {
                if (!empty($data[0]->GPSLatitude)) {
                    $this->image['GPSLatitude'] = $data[0]->GPSLatitude;
                    $this->gpsLatitude = true;
                }
                if (!empty($data[0]->GPSLongitude)) {
                    $this->image['GPSLongitude'] = $data[0]->GPSLongitude;
                    $this->gpsLongitude = true;
                }
                $this->image['DateTimeOriginal'] = $data[0]->DateTimeOriginal;
                $this->coordinatesCollection[] = $this->image;
            }
        } catch (Throwable $e) {
            report($e);
            Log::error($e->getMessage());
            return false;
        }
        return true;
    }

    /**
     * @param $lat
     * @param $lon
     * @return bool
     */
    protected function callGoogleForAddress($lat, $lon): bool
    {
        if (empty($lat) || empty($lon)) {
            return false;
        }
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($lat) . ',' . trim(
                $lon
            ) . '&key='.env('GOOGLE');
        $data = json_decode(file_get_contents($url));
        if ($data->status === 'OK') {
            $this->address = str_replace("'", '', $data->results[0]->formatted_address);

            return true;
        }
        return false;
    }

    /**
     * @param $customProperties
     * @param string $thumb
     * @param string $preview
     * @return void
     */
    protected function writeIntoMarkerFile($customProperties, string $thumb, string $preview): void
    {
        fwrite(
            $this->fileHandle,
            '{ "Address": "' . array_key_exists('address', $customProperties) ? $customProperties['address'] : '' . '",
         "DateTimeOriginal": "' . $customProperties['DateTimeOriginal'] . '",
          "thumb": "' . basename($thumb) . '",
          "preview": "' . basename($preview) . '",
          "lon": "' . $customProperties['lon'] . '",
          "lat": "' . $customProperties['lat'] . '"},'
        );
    }

    /**
     * @param SimpleXMLElement $xml
     * @return void
     */
    public function writeIntoTrackFile(SimpleXMLElement $xml): void
    {
        $elements = [];
        foreach ($xml->trk->children() as $trkseg) {
            $elements[] = $trkseg;
        }
        foreach ($elements[2] as $lr) {
            fwrite($this->fileHandle, self::START . $lr['lon'] . ',' . $lr['lat'] . self::END . ',');
        }
    }

    /**
     * @param ModelMediaCollection $imageFileMedia
     * @param GeoInformation $event
     * @return void
     */
    public function doGeoImageOperations(ModelMediaCollection $imageFileMedia, GeoInformation $event): void
    {
        $this->setPath(dirname($imageFileMedia->first()->getPath()));
        foreach ($imageFileMedia as $imageFile) {
            $this->readExifs($imageFile->getPath());
            $imageFile->setCustomProperty('DateTimeOriginal', $this->image['DateTimeOriginal']);
            if (!$this->gpsLatitude && !$this->gpsLongitude) {
                $gpx = $event->journey->getMedia('gpx');
                $this->image['GPSLatitude'] = '';
                $this->image['GPSLongitude'] = '';
                $this->readCoordinatesFromGPXFile($gpx, $imageFile);
                if (!$this->readExifs($imageFile->getPath())) {
                    Log::error('read exif goes wrong');
                }
            }
            Log::debug('GPSLatitude' . $this->image['GPSLatitude']);
            $imageFile->setCustomProperty('lat', $this->image['GPSLatitude']);
            $imageFile->setCustomProperty('lon', $this->image['GPSLongitude']);
            $this->address = '';
            if (!$this->callGoogleForAddress($this->image['GPSLatitude'], $this->image['GPSLongitude'])) {
                Log::error('call to google failed');
                continue;
            }
            if($this->address) {
                $imageFile->setCustomProperty('address', $this->address);
            }
            $imageFile->save();
        }
        $this->writeMarkerFile($imageFileMedia);
    }

    /**
     * @param ModelMediaCollection $gpxFileMedia
     * @return void
     */
    public function doGPXOperations(ModelMediaCollection $gpxFileMedia): void
    {
        $this->setPath(dirname($gpxFileMedia->first()->getPath()));
        $this->startWriteFile(self::LINE_FILE);
        foreach ($gpxFileMedia as $gpxFile) {
            $xml = simplexml_load_string(file_get_contents($gpxFile->getPath())) or die('Error: Cannot create object');
            $metadataTime = explode(':', $xml->metadata->time);
            $gpxFile->setCustomProperty('start_time', $metadataTime[0]);
            $gpxFile->setCustomProperty('lat', $metadataTime[1]);
            $gpxFile->setCustomProperty('lon', $metadataTime[2]);
            $gpxFile->save();
            $this->writeIntoTrackFile($xml);
        }
        $this->endWriteFile(self::LINE_FILE);
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @param $exifData
     * @return void
     */
    protected function addToCollection($exifData): void
    {
        $this->coordinatesCollection[]['GPSLatitude'] = $exifData[0]['GPSLatitude'];
        $this->coordinatesCollection[]['GPSLongitude'] = $exifData[0]['GPSLongitude'];
        $this->coordinatesCollection[]['DateTimeOriginal'] = $exifData[0]['DateTimeOriginal'];
    }

    /**
     * @param $targetFile
     * @return void
     */
    protected function startWriteFile($targetFile): void
    {
        $this->fileHandle = fopen($this->path . '/' . $targetFile, 'w+');
        fwrite($this->fileHandle, self::START);
    }

    /**
     * @return void
     */
    protected function endWriteFile($targetFile): void
    {
        $stat = fstat($this->fileHandle);
        ftruncate($this->fileHandle, $stat['size'] - 1);
        fclose($this->fileHandle);
        $myfile = fopen($this->path . '/' . $targetFile, 'a+');
        fwrite($myfile, self::END);
    }

    /**
     * @param $event
     * @param $imageFile
     * @return string
     */
    public function readCoordinatesFromGPXFile($gpxFileMedia, $imageFile): string
    {
        $output = [];
        if ($gpxFileMedia->count() > 0) {
            foreach ($gpxFileMedia as $gpxFile) {
                $output = [];
//                $result = shell_exec(
//                    'exiftool -geotag ' . $gpxFile->getPath() . ' -GeoSync=+2 ' . $imageFile->getPath()
//                );

                Log::info(
                    config('app.exif_tool_path') . ' -geotag ' . $gpxFile->getPath(
                    ) . ' -GeoSync=+2 ' . $imageFile->getPath()
                );
                exec(
                    config('app.exif_tool_path') . ' -geotag ' . $gpxFile->getPath(
                    ) . ' -GeoSync=+2 ' . $imageFile->getPath(),
                    $output
                );

                if (str::contains(json_encode($output), '1 image files updated')) {
                    Log::debug(json_encode($output));
                    return json_encode($output);
                }

//                $str .= $result->output();
                if (Str::contains(json_encode($output), 'error')) {
                    Log::error(json_encode($output));
                    Log::error('exiftool -geotag ' . $gpxFile->getPath() . ' -GeoSync=+2 ' . $imageFile->getPath());
                    return false;
                }
            }
        }
        return json_encode($output);
    }

    public function writeMarkerFile($imageFileMedia): void
    {
        $this->startWriteFile(self::MARKER_FILE);
        foreach ($imageFileMedia as $imageFile) {
            $this->writeIntoMarkerFile(
                $imageFile->custom_properties,
                $imageFile->getPath('thumb'),
                $imageFile->getPath('preview')
            );
        }
        $this->endWriteFile(self::MARKER_FILE);
    }
}
