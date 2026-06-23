<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'slug', 'title', 'category', 'location', 'year', 'area', 'image',
        'summary', 'overview', 'scope', 'gallery', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'scope' => 'array',
        'gallery' => 'array',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
