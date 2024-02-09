<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'address_has_user',
        'address',
        'country',
        'zipcode',
        'address1',
        'country1',
        'zipcode1'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'address_has_user');
    }
}
