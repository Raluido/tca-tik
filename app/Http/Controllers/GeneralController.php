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
        if ($filterBy == 0) {
            $fillwheres = '';
        } else {
            $fillwheres = ' WHERE categories.id =' . $filterBy;
        }

        // $products = Db::select("SELECT products.id, products.name, products.prefix, products.price, products.tax, products.observations, products.description, images.filename FROM items  
        // INNER JOIN product_storehouses ON product_storehouses.id = items.item_has_product_storehouses
        // INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        // INNER JOIN images ON images.image_has_product = products.id
        // INNER JOIN storehouses ON storehouses.id = product_storehouses.product_storehouse_has_storehouses
        // INNER JOIN categories ON categories.id = products.product_has_category
        // $fillwheres GROUP BY products.id, products.name, products.prefix, products.price, products.tax, products.observations, products.description, images.filename ORDER BY products.id DESC LIMIT 10 OFFSET $offset;");

        $products = Product::all();

        return view('main', ['products' => $products]);
    }
}
