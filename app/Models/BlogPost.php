<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'slug', 'title', 'category', 'date', 'read',
        'image', 'excerpt', 'body', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'body' => 'array',
        'read' => 'integer',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
