<?php

namespace App\Http\Controllers;

use Pdp\Domain;
use Pdp\TopLevelDomains;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Config;

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
            $parsedUrl = parse_url($image->getUrl()); 
            $images[$image->id]['url'] = 
                Str::replace($parsedUrl['host'], Config::get('domains.domain.berliner_photo_blog_domain'), $image->getUrl());;
            $images[$image->id]['getFullUrl'] = $image->file_name;
            $images[$image->id]['path'] = $image->getPath();
        }
        return view(
            config('app.base_domain_path', env('APP_BASE_DOMAIN_NAME')) . '/welcome',
            compact('images')
        );
    }
}
