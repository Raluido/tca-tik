<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Storehouse extends Model
{
    use HasFactory;

    public function products()
    {
        $this->belongsToMany(Product::class);
    }
}
