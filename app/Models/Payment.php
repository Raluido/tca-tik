<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_has_user',
        'type',
        'provider',
        'account_number',
        'card_expiration_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'payment_has_user');
    }
}
