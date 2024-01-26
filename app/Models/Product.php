<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Storehouse;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_has_category',
        'name',
        'price',
        'observations',
        'description'
    ];

    public function categoryProduct()
    {
        return $this->belongsTo(Category::class, 'product_has_category');
    }

    public function storehouses()
    {
        return $this->belongsToMany(Storehouse::class);
    }
}
