<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_price extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shipping_price_has_products',
        'company',
        'dimensions',
        'weight',
        'destination',
        'value',
        'price'
    ];

    public function product()
    {
        return $this->belongsTo(Order::class, 'shipping_price_has_products');
    }
}
