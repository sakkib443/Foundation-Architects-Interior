<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'slug', 'title', 'tagline', 'icon', 'image',
        'summary', 'intro', 'features', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'features' => 'array',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
