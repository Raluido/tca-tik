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
        $products = Product::with('category')
            ->with('images')
            ->with('latestItems')
            ->where(function ($query) use ($filterBy) {
                if ($filterBy != 0) {
                    $query->where('products.product_has_category', '=', $filterBy);
                }
            })
            ->get();

        log::info($products);
        die();

        return view('main', ['products' => $products]);
    }
}
