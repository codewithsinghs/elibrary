<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'caption', 'description', 'url', 'published_at', 'category', 'author', 'image', 'thumbnail',
    ];
}
