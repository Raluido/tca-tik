<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'log_has_user',
        'code',
        'key',
        'value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'log_has_user');
    }
}
