<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product_storehouse;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'item_has_product_storehouses',
        'item_has_order',
        'action',
        'pricepu',
        'quantity',
        'stock'
    ];

    public function product_storehouse()
    {
        return $this->belongsTo(Product_storehouse::class, 'item_has_product_storehouses');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'item_has_order');
    }
}
