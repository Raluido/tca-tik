<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'review_has_user',
        'review_has_product',
        'content',
        'rate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'review_has_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'review_has_product');
    }
}
