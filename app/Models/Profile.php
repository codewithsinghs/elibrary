<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    
    protected $fillable = [
        'user_id',

        'unic_id',
        
        'fname',
        'lname',
        'email',
        'dob',
        'gender',

        'member_type',
        'member_id',
        'year_of_admission',
        'year_of_joining',
       
        'category', 'institute', 'faculty', 'department', 'course', 'designation',

        'phone',
        'alternate_email',
        'present_address',
        'present_city',
        'present_pincode',

        'permanent_address',
        'permanent_city',
        'permanent_pincode',
        'permanent_phone',

        'preferred_genres',
        'preferred_language',
        'favorite_resources',
        'communication_preferences',
        'research_interests',
        'social_integration',

        'image',

        // 'role_position',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isCompleted()
    {
        return !empty($this->name) &&
            !empty($this->email);
    }
}
