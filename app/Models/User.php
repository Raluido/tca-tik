<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Address;
use App\Models\Log;
use App\Models\Review;
use App\Models\Payment;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'birthdate',
        'password',
        'email',
        'avatar',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'address_has_user');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'log_has_user');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'payment_has_user');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'review_has_user');
    }

    public function tickets()
    {
        return $this->hasMany(Review::class, 'ticket_reply_has_ticket');
    }
}
