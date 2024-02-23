<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class GeneralController extends Controller
{
    public function showmain()
    {
        $categories = Category::all();

        return view('main', ['categories' => $categories]);
    }

    public function showProductsAjax($filterBy = 0, $search = 0, $offset = 0)
    {
        $filterByAnd = " AND categories.id = " . $filterBy;
        $searchAnd = " AND products.id = " . $search;
        $fillWheres = '';

        if ($filterBy == 0 && $search != 0) {
            $fillWheres = $searchAnd;
        } elseif ($filterBy != 0 && $search == 0) {
            $fillWheres = $filterByAnd;
        } elseif ($filterBy != 0 && $search != 0) {
            $fillWheres = $filterByAnd . $searchAnd;
        }

        $products = Db::select("SELECT products.name AS pname, products.prefix AS pprefix, products.price AS pprice, products.description AS pdescription, products.observations AS pobservations, categories.name AS cname, sum(t.stock) AS stockTotal, GROUP_CONCAT(DISTINCT images.filename) AS imageFilename
        FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY item_has_product_storehouses ORDER BY updated_at DESC) AS rownumber FROM items) t
        INNER JOIN product_storehouses ON product_storehouses.id = t.item_has_product_storehouses
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN storehouses ON storehouses.id = product_storehouses.product_storehouse_has_storehouses
        INNER JOIN categories ON categories.id = products.product_has_category
        LEFT JOIN images ON products.id = images.image_has_product
        WHERE t.rownumber = 1
        $fillWheres
        GROUP BY products.id;");

        [$pagination, $totalPrd] = $this->paginator(count($products));

        $products = Db::select("SELECT products.id, products.name AS pname, products.prefix AS pprefix, products.price AS pprice, products.description AS pdescription, products.observations AS pobservations, categories.name AS cname, sum(t.stock) AS stockTotal, GROUP_CONCAT(DISTINCT images.filename) AS imageFilename
        FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY item_has_product_storehouses ORDER BY updated_at DESC) AS rownumber FROM items) t
        INNER JOIN product_storehouses ON product_storehouses.id = t.item_has_product_storehouses
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN storehouses ON storehouses.id = product_storehouses.product_storehouse_has_storehouses
        INNER JOIN categories ON categories.id = products.product_has_category
        LEFT JOIN images ON products.id = images.image_has_product
        WHERE t.rownumber = 1
        $fillWheres
        GROUP BY products.id LIMIT 10 OFFSET $offset;");

        return ['products' => $products, 'filterBy' => $filterBy, 'offset' => $offset, 'pagination' => $pagination, 'totalPrd' => $totalPrd];
    }

    function paginator($totalPrd)
    {
        $offsetGroups = $totalPrd / 10;

        if ($this->is_decimal($offsetGroups)) $offsetGroups = round($offsetGroups);
        else $offsetGroups = round($offsetGroups);

        $pagination = array();

        for ($i = 0; $i < $offsetGroups; $i++) {
            $pagination[] = (object)[
                'page' => $i,
                'offset' => $i * 10
            ];
        }

        return [$pagination, $totalPrd];
    }

    function is_decimal($val)
    {
        return is_numeric($val) && floor($val) != $val;
    }

    public function searchByProduct($inputSearch = '')
    {
        if ($inputSearch != '') {
            $productFiltered = Product::where('products.name', 'LIKE', '%' . $inputSearch . '%')
                ->get();
        } else {
            $productFiltered = null;
        }

        return $productFiltered;
    }
}
