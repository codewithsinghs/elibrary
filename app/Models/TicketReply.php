<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketReply extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['support_ticket_id', 'user_id', 'reply', 'file_name', 'file_path'];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
   
    protected $casts = [
        'user_id' => 'integer',
    ];

     // Define a relationship with the support ticket
     public function supportTicket()
     {
         return $this->belongsTo(SupportTicket::class);
     }

     public function attachments()
    {
        return $this->morphMany(TicketAttachment::class, 'attachable');
    }

     public function user()
    {
        return $this->belongsTo(User::class);
    }

}