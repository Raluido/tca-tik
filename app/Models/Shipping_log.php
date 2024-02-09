<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Shipping_log extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shipping_log_has_order',
        'tracking_number',
        'departure',
        'estimated_arrived'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'shipping_log_has_order');
    }
}
