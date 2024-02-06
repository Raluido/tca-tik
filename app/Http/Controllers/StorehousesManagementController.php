<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storehouse;
use App\Models\Product;
use App\Models\Category;
use App\Models\Product_storehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StorehousesManagementController extends Controller
{
    public function showProducts()
    {
        $categories = Category::all();
        $storehouses = Storehouse::all();
        $products = Product::all();

        return view('management.showProducts', ['storehouses' => $storehouses, 'categories' => $categories, 'products' => $products]);
    }

    public function showAllAjax($searchProductId = 0, $offset = 0)
    {
        if ($searchProductId != 0) {
            $searchWhere = "WHERE products.id = " . $searchProductId;
        } else {
            $searchWhere = '';
        }

        $countAllProducts = Db::select("SELECT products.product_has_category AS id, products.id AS pid, products.name AS pname, products.price AS pprice, products.prefix AS pprefix, categories.name AS pcategory, product_storehouses.product_storehouse_has_products, COUNT(*) as total FROM product_storehouses
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN categories ON categories.id = products.product_has_category
        $searchWhere GROUP BY product_storehouses.product_storehouse_has_products, products.product_has_category, products.id, products.name, products.price, products.prefix, categories.name ORDER BY products.id");

        $totalPrd = count($countAllProducts);
        $offsetGroups = $totalPrd / 10;

        if ($this->is_decimal($offsetGroups)) $offsetGroups = round($offsetGroups);
        else $offsetGroups = round($offsetGroups) - 1;

        $pagination = array();

        for ($i = 0; $i < $offsetGroups; $i++) {
            $pagination[] = (object)[
                'page' => $i,
                'offset' => $i * 10
            ];
        }

        $productsAll = Db::select("SELECT products.product_has_category AS id, products.id AS pid, products.name AS pname, products.price AS pprice, products.prefix AS pprefix, categories.name AS pcategory, product_storehouses.product_storehouse_has_products, COUNT(*) as total FROM product_storehouses
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN categories ON categories.id = products.product_has_category
        $searchWhere GROUP BY product_storehouses.product_storehouse_has_products, products.product_has_category, products.id, products.name, products.price, products.prefix, categories.name ORDER BY products.id LIMIT 10 OFFSET $offset");

        return ['productsAll' => $productsAll, 'search' => $searchProductId, 'pagination' => $pagination, 'offset' => $offset, 'totalPrd' => $totalPrd];
    }

    public function showFilteredAjax($storehouseSelectedId = 0, $categorySelectedId = 0, $productSelectedId = 0, $searchProductId = 0, $offset = 0)
    {
        $fillWheres = '';

        $catWhere = "WHERE categories.id = " .  $categorySelectedId;
        $storeWhere = "WHERE storehouses.id = " . $storehouseSelectedId;
        $catAnd = "AND categories.id = " . $categorySelectedId;
        $searchAnd = "AND products.id = " . $searchProductId;
        $searchWhere = "WHERE products.id = " . $searchProductId;

        if ($storehouseSelectedId == 0 && $categorySelectedId != 0 && $searchProductId == 0) {
            $fillWheres = $catWhere;
        } elseif ($storehouseSelectedId != 0 && $categorySelectedId == 0 && $searchProductId == 0) {
            $fillWheres = $storeWhere;
        } elseif ($categorySelectedId != 0 && $storehouseSelectedId != 0 && $searchProductId == 0) {
            $fillWheres = $storeWhere . ' ' . $catAnd;
        } elseif ($storehouseSelectedId == 0 && $categorySelectedId != 0 && $searchProductId != 0) {
            $fillWheres = $catWhere  . ' ' .  $searchAnd;
        } elseif ($storehouseSelectedId != 0 && $categorySelectedId == 0 && $searchProductId != 0) {
            $fillWheres = $storeWhere  . ' ' .  $searchAnd;
        } elseif ($categorySelectedId != 0 && $storehouseSelectedId != 0 && $searchProductId != 0) {
            $fillWheres = $storeWhere  . ' ' .  $catAnd . ' ' . $searchAnd;
        } elseif ($categorySelectedId == 0 && $storehouseSelectedId == 0 && $searchProductId != 0) {
            $fillWheres = $searchWhere;
        }

        if ($fillWheres != '') {

            $filtered = Db::select("SELECT products.product_has_category AS id, storehouses.name AS name, storehouses.prefix AS prefix, storehouses.description AS description, products.id AS pid, products.name AS pname, products.price AS pprice, products.prefix AS pprefix, categories.name AS pcategory, product_storehouses.product_storehouse_has_products, product_storehouses.product_storehouse_has_storehouses, COUNT(*) as total FROM storehouses
        INNER JOIN product_storehouses ON product_storehouses.product_storehouse_has_storehouses = storehouses.id
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN categories ON categories.id = products.product_has_category
        $fillWheres GROUP BY product_storehouses.product_storehouse_has_products, product_storehouses.product_storehouse_has_storehouses, products.product_has_category, storehouses.name, storehouses.prefix, storehouses.description, products.id, products.name, products.price, products.prefix, categories.name");
        } else {
        }

        $totalPrd = count($filtered);
        $offsetGroups = $totalPrd / 10;

        if ($this->is_decimal($offsetGroups)) $offsetGroups = round($offsetGroups);
        else $offsetGroups = round($offsetGroups) - 1;

        $pagination = array();

        for ($i = 0; $i < $offsetGroups; $i++) {
            $pagination[] = (object)[
                'page' => $i,
                'offset' => $i * 10
            ];
        }

        $filtered = Db::select("SELECT products.product_has_category AS id, storehouses.name AS name, storehouses.prefix AS prefix, storehouses.description AS description, products.id AS pid, products.name AS pname, products.price AS pprice, products.prefix AS pprefix, categories.name AS pcategory, product_storehouses.product_storehouse_has_products, product_storehouses.product_storehouse_has_storehouses, COUNT(*) as total FROM storehouses
        INNER JOIN product_storehouses ON product_storehouses.product_storehouse_has_storehouses = storehouses.id
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN categories ON categories.id = products.product_has_category
        $fillWheres GROUP BY product_storehouses.product_storehouse_has_products, product_storehouses.product_storehouse_has_storehouses, products.product_has_category, storehouses.name, storehouses.prefix, storehouses.description, products.id, products.name, products.price, products.prefix, categories.name ORDER BY products.id LIMIT 10 OFFSET $offset");

        return ['filtered' => $filtered, 'pagination' => $pagination, 'searchProductId' => $searchProductId, 'offset' => $offset, 'totalPrd' => $totalPrd];
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






    public function productsCounter(Request $request)
    {
        $products = Db::table('product_storehouses')->where('product_storehouse_has_storehouses', $request->storehouseId)->where('product_storehouse_has_products', $request->productId)->count();

        return $products;
    }


    public function addToStorehouse($storehouse, $product)
    {
        Product_storehouse::create(['product_storehouse_has_products' => $product, 'product_storehouse_has_storehouses' => $storehouse]);

        $productCount = Db::table('product_storehouses')->where('product_storehouse_has_storehouses', $storehouse)->where('product_storehouse_has_products', $product)->count();

        return [$productCount, $product];
    }

    public function removeFromStorehouse(Storehouse $storehouse, Product $product)
    {
        Db::table('product_storehouses')->where('product_storehouse_has_products', $product->id)->where('product_storehouse_has_storehouses', $storehouse->id)->orderBy('id')->limit(1)->delete();

        $productCount = Db::table('product_storehouses')->where('product_storehouse_has_storehouses', $storehouse->id)->where('product_storehouse_has_products', $product->id)->count();

        return [$productCount, $product->id];
    }
}
