<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;


    protected $fillable = [
        'local_user_id',
        // 'external_user_id',
        'unic_id',
        'page_name',
        'url',
        'start_time',
        'end_time',
        'time_spent',
        'session_id',
    ];

    // Define relationships if needed, for example:
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'local_user_id');
    // }
    protected $dates = ['start_time', 'end_time'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'from_time' => 'datetime',
        'to_time' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'local_user_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'local_user_id', 'user_id');
    }

    public $timestamps = true;

}
