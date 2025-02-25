<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class StorageService
{
    public static function saveToStorage($request, $content): void
    {
        foreach ($request->input('upload', []) as $file) {
            if (empty($file)) {
                continue;
            }
            $path = storage_path(env('STORAGE_PATH')) . Auth::user()->id . '/' . $file;
            if (File::mimeType($path) === 'image/jpeg') {
                $mediaItem = $content->addMedia($path)->toMediaCollection('images');
                $mediaItem->meta = $content->header;
                $mediaItem->headline = $content->header;
                $mediaItem->description = $content->text;
                $mediaItem->keywords = implode(', ', $content->tags()->pluck('name')->toArray());
                $mediaItem->website = $content->website;
                $mediaItems = $content->getMedia('images');
                $date = ImageService::parseData('T -createdate', $mediaItems[0]->getPath(), '');
                if ($date === '-' || empty($date)) {
                    $date = Carbon::now();
                }
                $mediaItem->date = $date;
                if ($mediaItem->headline == '') {
                    $mediaItem->headline = $content->header = ImageService::parseData(
                        'Headline',
                        $mediaItems[0]->getPath()
                    );
                    $mediaItem->meta = $content->metadescription = $content->header;
                }
                if ($content->text == '') {
                    $mediaItem->description = $content->text = ImageService::parseData(
                        'Description',
                        $mediaItems[0]->getPath()
                    );
                }
                if ($mediaItem->keywords === '') {
                    $mediaItem->keywords = ImageService::parseData('Keywords', $mediaItems[0]->getPath());
                    $tags = TagService::createTags($mediaItem->keywords);
                    $content->tags()->sync($tags);
                }
            } else {
                $mediaItem = $content->addMedia($path)->toMediaCollection();
            }
            $content->save();
            $mediaItem->save();
        }
    }
}
