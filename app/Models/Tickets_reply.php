<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class Tickets_reply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_reply_has_ticket',
        'ticket_has_user',
        'description'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_reply_has_ticket');
    }
}
