<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TagService
{
    public static function createTags($tags): array
    {
        $tagsArray = self::prepareTags($tags);
        return collect($tagsArray)->map(function (string $tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        })->all();
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
