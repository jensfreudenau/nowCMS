<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Job extends Model
{
    use Attributes;

    public $timestamps = false;

    protected $casts = [
        'payload' => 'array',
        'reserved_at' => 'datetime',
        'available_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('queue.connections.' . (Config::get('queue.default', 'database')) . '.table', 'jobs');
    }
}
