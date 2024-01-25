<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Storehouse;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        $this->hasOne(Category::class);
    }

    public function storehouses()
    {
        $this->belongsToMany(Storehouse::class);
    }
}
