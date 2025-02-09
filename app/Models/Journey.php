<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        $this->addMediaConversion('thumb')
            ->width(500)
            ->height(500);

        $this->addMediaConversion('preview')
            ->width(2000)
            ->height(2000)
        ;
        $this->addMediaConversion('square')
            ->fit(Fit::Contain, 100, 100);
    }
}
