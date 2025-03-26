<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BerlinerPhotoblogController extends BaseController
{
    public function index()
    {
        $images = [];
        $imagesContent = Media::whereLike('website', Str::before(config('app.berliner_photo_blog_domain'), '.') . '%')
            ->where('on_frontsite', true)
            ->orderByDesc('created_at')
            ->get();

        foreach ($imagesContent as $image) {
            $images[$image->id]['id'] = $image->id;
            $images[$image->id]['headline'] = $image->headline;
            $images[$image->id]['big_square'] = $image->getUrl('big_square');
            $images[$image->id]['url'] = $image->getUrl();
        }
        return view(
            config('app.base_domain_path', env('APP_BASE_DOMAIN_NAME')) . '/welcome',
            compact('images')
        );
    }
}
