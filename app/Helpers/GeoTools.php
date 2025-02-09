<?php

namespace App\Helpers;

final class GeoTools
{
    public static function createSmallImages($file)
    {
        $img = new Imagick();
        $thumb = new Imagick();
        $img->readImage($file);
        $thumb->readImage($file);
        $imageprops = $img->getImageGeometry();
        $width = $imageprops['width'];
        $height = $imageprops['height'];

        if ($width > $height) {
            $newHeight = 300;
            $thumbNewHeight = 80;
            $newWidth = ($newHeight / $height) * $width;
            $thumbNewWidth = ($thumbNewHeight / $height) * $width;
        } else {
            $newWidth = 300;
            $thumbNewWidth = 80;
            $newHeight = ($newWidth / $width) * $height;
            $thumbNewHeight = ($thumbNewWidth / $width) * $height;
        }
        $img->resizeImage((int)$newWidth, (int)$newHeight, imagick::FILTER_LANCZOS, 0.9, true);
        $img->cropImage($width, $height, 0, 0);
        $thumb->resizeImage((int)$thumbNewWidth, (int)$thumbNewHeight, imagick::FILTER_LANCZOS, 0.9, true);
        $thumb->cropImage($width, $height, 0, 0);
        $img->writeImage('300x300/' . $file);
        $thumb->writeImage('thumbs/' . $file);
    }

    public static function endWriteCoordinates()
    {
        $filename = 'marker.js';
        $fh = fopen($filename, 'r+') or die("can't open file");
        $stat = fstat($fh);
        ftruncate($fh, $stat['size'] - 1);
        fclose($fh);
        $end = ']';
        $myfile = fopen($filename, "a+");
        fwrite($myfile, $end);
    }

    public static function startWriteCoordinates()
    {
        $filename = 'marker.js';
        $start = '[';
        $myfile = fopen($filename, "w+");
        fwrite($myfile, $start);
    }

    public static function getAddress($lat, $lng)
    {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($lat) . ',' . trim($lng) . '&key=' . env('GOOGLE');
        $homepage = file_get_contents($url);

        $data = json_decode($homepage);

        if ($data->status == "OK") {
            return $data->results[0]->formatted_address;
        } else {
            return false;
        }
    }

    public static function writeGpsCoordinates($file, $array)
    {
//        $filename = 'marker.js';
//        $myfile = fopen($filename, 'a');
//        $start = '{ "data": { "trackData":[[';
//        eval('$array=' . `exiftool -c "%+8f" -EXIF:GPS -GPSLatitude -GPSLongitude -DateTimeOriginal -php {$file}`);
//        $ar = getAddress($array[0]['GPSLatitude'], $array[0]['GPSLongitude']);
//        self::readGPSCoordinates($filename);
//        fwrite($myfile, '{ "Address": "' . $ar . '", "DateTimeOriginal": "' . $array[0]['DateTimeOriginal'] . '", "picture": "' . $file . '", "lon": "' . $array[0]['GPSLongitude'] . '", "lat": "' . $array[0]['GPSLatitude'] . '"},');
    }

    public static function convertHeicToJpg($file)
    {
        $filename = basename($file, '.heic');
        shell_exec('magick ' . $file . ' -quality 100% ' . $filename . '.jpg');
    }

    public static function readGPSCoordinates($filename)
    {
        $array = [];
        eval('$array=' . `exiftool -c "%+8f" -EXIF:GPS -GPSLatitude -GPSLongitude -DateTimeOriginal -php {$filename}`);
        $coordinates['GPSLatitude'] = $array[0]['GPSLatitude'];
        $coordinates['GPSLongitude'] = $array[0]['GPSLongitude'];
        return $coordinates;
    }
}




