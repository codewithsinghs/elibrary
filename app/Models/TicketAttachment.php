<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketAttachment extends Model
{
    use HasFactory;

    // protected $fillable = ['support_ticket_id','ticket_reply_id', 'file_name', 'file_path', ];
    protected $fillable = ['attachable_id','attachable_type', 'file_name', 'file_path', ];

    protected $guarded = [];

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }



     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'support_ticket_id' => 'integer',
    ];

     // Define a relationship with the support ticket
     public function supportTicket()
     {
         return $this->belongsTo(SupportTicket::class);
     }

     public function ticketReply()
    {
        return $this->belongsTo(TicketReply::class);
    }

}