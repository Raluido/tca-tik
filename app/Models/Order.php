<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_has_user',
        'order_has_payment',
        'code',
        'total'
    ];

    public function products()
    {
        $this->belongsToMany(Product::class, 'order_product', 'order_product_has_order', 'order_product_has_product');
    }

    public function shipping_log()
    {
        return $this->hasOne(Shipping_log::class, 'shipping_log_has_order');
    }
}
