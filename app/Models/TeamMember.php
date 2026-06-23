<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name', 'role', 'photo', 'socials', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'socials' => 'array',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];
}
