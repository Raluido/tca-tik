<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_storehouse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_storehouse_has_storehouse',
        'product_storehouse_has_product'
    ];

    public function items()
    {
        $this->hasMany(Item::class, 'item_has_product_storehouse');
    }
}
