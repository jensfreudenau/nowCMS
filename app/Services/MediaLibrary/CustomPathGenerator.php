<?php

namespace App\Services\MediaLibrary;

use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{

    public function getPath(Media $media): string
    {
        $model = new $media->model_type;
        $factory = $model->find($media->model_id);
        if (empty($factory) || empty($factory->slug)) {
            Log::error('no slug:' . $model->id);
            return 'import/';
        }


        return $factory->slug . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }

    /**
     * @param string $path
     * @return void
     */
    public static function createPath(string $path): void
    {
        if (!file_exists($path)) {
            if (!mkdir($path, 0755) && !is_dir($path)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }
    }

    /*
     * Get a unique base path for the given media.
     */
    public function getBasePath(Media $media): string
    {
        $prefix = config('media-library.prefix', '');

        if ($prefix !== '') {
            return $prefix . '/' . $media->getKey();
        }

        return $media->getKey();
    }
}
