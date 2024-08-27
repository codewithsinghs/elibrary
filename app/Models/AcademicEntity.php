<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicEntity extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'institute', 'faculty', 'department', 'course_designation'];
}
