<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * @param string $key
     * @param string $path
     * @param string $quotes
     * @return string
     */
    public static function parseData(string $key, string $path, string $quotes = '"'): string
    {
        $result = Process::run('exiftool ' .  $quotes . '-' . $key . $quotes .' '. $path);
        $str = Str::after($result->output(), ': ');

        return Str::chopEnd($str, "\n");
    }

    public static function parseText(string $text): string
    {
        $replace = Str::replace('..', "\r\n", $text);
        $between = Str::between($replace, '##', '.');
        $replaceBetween = Str::replace('.', "\r\n", $between);

        return Str::replace($between, $replaceBetween, $replace);
    }
}
