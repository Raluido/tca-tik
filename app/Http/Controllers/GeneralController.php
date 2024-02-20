<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeneralController extends Controller
{
    public function showmain($filterBy = 0, $offset = 0)
    {
        $products = Product::join('categories', 'categories.id', '=', 'products.product_has_category')
            ->where(function ($query) use ($filterBy) {
                if ($filterBy != 0) {
                    $query->where('categories.id', '=', 1);
                }
            })
            ->get();

        log::info($products[0]->storehouses[0]->pivot->images);

        return view('main', ['products' => $products]);
    }
}
