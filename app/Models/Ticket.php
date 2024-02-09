<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tickets_reply;
use App\Models\User;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_has_user',
        'section',
        'title',
        'email',
        'description',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ticket_has_user');
    }

    public function ticket_replies()
    {
        return $this->hasMany(Tickets_reply::class, 'ticket_reply_has_ticket');
    }
}
