<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;


class Journey extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory, Sluggable, SluggableScopeHelpers;
    protected $fillable = [
        'name_of_route',
        'description',
        'start_date',
        'slug',
        'user_id',
        'active',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_of_route',
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function registerMediaConversions(Media $media = null): void
    {
        //https://www.youtube.com/watch?v=Ho9OVdxpFRM
        $this->addMediaConversion(Config::get('conversions.journey.400x400'))
            ->fit(Fit::Crop, 400, 400, true)
            ->withResponsiveImages()
            ->optimize()
            ->keepOriginalImageFormat();

        $this->addMediaConversion(Config::get('conversions.journey.300x300'))
            ->fit(Fit::Crop, 300, 300, true)
            ->withResponsiveImages()
            ->optimize();

        $this->addMediaConversion(Config::get('conversions.journey.w300xh300'))
            ->fit(Fit::Contain, 400, 400, true)
            ->withResponsiveImages()
            ->keepOriginalImageFormat()
            ->optimize();

        $this->addMediaConversion(Config::get('conversions.journey.w600xh600'))
            ->keepOriginalImageFormat()
            ->fit(Fit::Contain, 600, 600, true)
            ->withResponsiveImages()
            ->optimize();

        $this->addMediaConversion(Config::get('conversions.journey.w800xh800'))
            ->keepOriginalImageFormat()
            ->fit(Fit::Contain, 800, 800, true)
            ->withResponsiveImages()
            ->optimize()
            ->quality(80);

        $this->addMediaConversion(Config::get('conversions.journey.800x800'))
            ->fit(Fit::Crop, 800, 800, true)
            ->withResponsiveImages()
            ->optimize();
    }
}
