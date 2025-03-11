<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Content extends Model implements HasMedia, Feedable
{
    use InteractsWithMedia;
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'contents';

    protected $fillable = [
        'header',
        'metadescription',
        'slug',
        'text',
        'active',
        'single',
        'date',
        'category_id',
        'website',
        'updated_at'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->header)
            ->summary($this->metadescription)
            ->link(url('/single', $this->slug))
            ->updated($this->updated_at)
            ->authorName('Jens')
            ->authorEmail('Jens@freudefoto.de');
    }

    public static function getFeedItems()
    {
        return Content::where('active', true)
            ->whereLike('website', config('app.base_domain_path') . '%')
            ->get();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'header'
            ]
        ];
    }

    public function germanDate()
    {
        return Carbon::parse($this->date)->translatedFormat('d. F Y');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        //https://www.youtube.com/watch?v=Ho9OVdxpFRM
        $this->addMediaConversion('big_thumb_square')
            ->fit(Fit::Crop, 400, 400, true)
            ->withResponsiveImages()
            ->optimize()
            ->keepOriginalImageFormat();

        $this->addMediaConversion('thumb_square')
            ->fit(Fit::Crop, 300, 300, true)
            ->withResponsiveImages()
            ->optimize();

        $this->addMediaConversion('big_thumb')
            ->fit(Fit::Contain, 400, 400, true)
            ->withResponsiveImages()
            ->keepOriginalImageFormat()
            ->optimize();

        $this->addMediaConversion('preview')
            ->keepOriginalImageFormat()
            ->fit(Fit::Contain, 600, 600, true)
            ->withResponsiveImages()
            ->optimize();

        $this->addMediaConversion('big_preview')
            ->keepOriginalImageFormat()
            ->fit(Fit::Contain, 800, 800, true)
            ->withResponsiveImages()
            ->optimize()
            ->quality(80);

        $this->addMediaConversion('big_square')
            ->fit(Fit::Crop, 800, 800, true)
            ->withResponsiveImages()
            ->optimize();
    }
}
