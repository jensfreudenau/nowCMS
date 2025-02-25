<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;


class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $fillable = ['name'];

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class)
            ->whereLike('website', Str::before( config('app.base_domain'), '.') . '%');
    }

    public function contentsAll(): BelongsToMany
    {
        return $this->belongsToMany(Content::class);
    }

    public function getRouteKeyName(): string
    {
        return 'name';
    }
}
