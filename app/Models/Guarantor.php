<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guarantor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'gr_fname', 'gr_lname', 'form_number', 'library_member', 'gr_phone', 'gr_email', 'gr_address', 'gr_city', 'gr_pincode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}






