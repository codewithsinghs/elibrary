<?php

namespace App\Models;

use App\Models\User;
use App\Models\TicketReply;
use App\Models\TicketAttachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportTicket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'category',
        'subject',
        'message',
        'status',
        'reply',
        'ticket_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user that owns the support ticket.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attachments for the support ticket.
     */
    public function attachments()
    {
        // return $this->hasMany(TicketAttachment::class);
        return $this->morphMany(TicketAttachment::class, 'attachable');
    }



    // public function attachments(): MorphMany
    // {
    //     return $this->morphMany(Attachment::class, 'attachable');
    // }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }

    /**
     * Scope a query to only include open support tickets.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    /**
     * Scope a query to only include closed support tickets.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    /**
     * Generate a unique ticket ID for the support ticket.
     *
     * @return void
     */
    public function generateTicketId()
    {
        $this->ticket_id = uniqid();
    }
}
