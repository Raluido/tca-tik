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
        $products = Db::select("SELECT products.name AS pname, products.prefix AS pprefix, products.price AS pprice, products.description AS pdescription, products.observations AS pobservations, categories.name AS cname, images.filename, sum(t.stock) AS stockTotal 
        FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY item_has_product_storehouses ORDER BY updated_at DESC) AS rownumber FROM items) t
        INNER JOIN product_storehouses ON product_storehouses.id = t.item_has_product_storehouses
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN storehouses ON storehouses.id = product_storehouses.product_storehouse_has_storehouses
        INNER JOIN categories ON categories.id = products.product_has_category
        LEFT JOIN images ON products.id = images.image_has_product AND images.id = 
        (SELECT MIN(id) FROM images)
        WHERE t.rownumber = 1
        GROUP BY products.id, images.filename;");

        log::info($products);
        die();

        return view('main', ['products' => $products]);
    }
}
