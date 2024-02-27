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
        'total',
        'tax'
    ];

    public function shipping_log()
    {
        return $this->hasOne(Shipping_log::class, 'shipping_log_has_order');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'item_has_order');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_has_order');
    }
}
