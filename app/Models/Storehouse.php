<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Storehouse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prefix',
        'name',
        'address',
        'description'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_storehouses', 'product_storehouse_has_storehouses', 'product_storehouse_has_products');
    }
}
