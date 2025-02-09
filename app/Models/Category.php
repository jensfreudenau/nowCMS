<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name'];

    protected $table = 'categories';

    protected $fillable = ['name'];

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function en()
    {
        return $this->hasOne(CategoryTranslation::class)->where('locale', 'en');
    }

    public function de()
    {
        return $this->hasOne(CategoryTranslation::class)->where('locale', 'de');
    }
}
