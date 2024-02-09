<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_product;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cart_has_order_product',
        'quantity',
        'total'
    ];

    public function order_product()
    {
        return $this->belongsTo(Order_product::class, 'cart_has_order_product');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_has_cart');
    }
}
