<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Storehouse;
use App\Models\Image;
use App\Models\Shipping_price;
use App\Models\Review;

class Product extends Model
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
        'product_has_category',
        'product_has_discount',
        'price',
        'tax',
        'observations',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'product_has_category');
    }

    public function storehouses()
    {
        return $this->belongsToMany(Storehouse::class, 'product_storehouse', 'product_storehouse_has_product', 'product_storehouse_has_storehouse');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'image_has_product');
    }

    public function shipping_prices()
    {
        return $this->hasMany(Shipping_price::class, 'shipping_price_has_products');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'order_product_has_order', 'order_product_has_product');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'product_has_discount');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'review_has_product');
    }
}
