<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_has_cart',
        'number',
        'isPaid',
        'paymentDate'
    ];

    public function cart()
    {
        $this->belongsTo(Cart::class, 'invoice_has_cart');
    }
}
