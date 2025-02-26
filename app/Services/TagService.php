<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TagService
{
    public static function createTags($tags): array
    {
        if(gettype($tags) === 'string') {
            return self::savaJsonTags($tags);
        }
        $tagsArray = self::prepareTags($tags);
        return collect($tagsArray)->map(function (string $tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        })->all();
    }

    private static function savaJsonTags($tags): array {
        $tagObjects = json_decode($tags);
        $tags = [];
        foreach ($tagObjects as $tagObject) {
            $tags[] = Tag::firstOrCreate(['name' => $tagObject->value])->id;
        }
        return $tags;
    }

    public static function prepareTags($tags): array|Collection
    {
        if (is_array($tags)) {
            return $tags;
        }
        $replaced = Str::replace(' ', '#', $tags);
        $replaced = Str::replace(',', '#', $replaced);
        $explode = Str::of($replaced)->explode('#');
        return collect($explode)->filter();
    }
}
