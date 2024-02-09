<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

class Order_product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_product_has_order',
        'order_product_has_product'
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class, 'cart_has_order_product');
    }
}
