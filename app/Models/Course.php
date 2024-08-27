<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
     use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'duration', 'category', 'level', 'instructor', 'price', 'start_date', 'end_date', 'prerequisites'];
}
