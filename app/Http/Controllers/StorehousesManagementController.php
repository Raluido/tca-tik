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
    public function showall($offset = 0, $inputSearch = 0, $productSelectedId = 0)
    {
        $categories = Category::all();
        $storehouses = Storehouse::all();

        $totalPrd = Db::table('products')->count();
        $offsetGroups = $totalPrd / 10;

        if ($this->is_decimal($offsetGroups)) $offsetGroups = round($offsetGroups);
        else $offsetGroups = round($offsetGroups) - 1;

        for ($i = 0; $i < $offsetGroups; $i++) {
            $pagination[] = (object)[
                'page' => $i,
                'offset' => $i * 10
            ];
        }

        $allProductsInStr = Db::select("SELECT products.product_has_category AS id, products.id AS pid, products.name AS pname, products.price AS pprice, products.prefix AS pprefix, categories.name AS pcategory, product_storehouses.product_storehouse_has_products, COUNT(*) as total FROM product_storehouses
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN categories ON categories.id = products.product_has_category
        GROUP BY product_storehouses.product_storehouse_has_products, products.product_has_category, products.id, products.name, products.price, products.prefix, categories.name ORDER BY products.id LIMIT 10 OFFSET $offset");

        return view('management.showall', ['allProductsInStr' => $allProductsInStr, 'storehouses' => $storehouses, 'categories' => $categories, 'pagination' => $pagination, 'offset' => $offset, 'totalPrd' => $totalPrd, 'inputSearch' => $inputSearch, 'productSelectedId' => $productSelectedId]);
    }

    function is_decimal($val)
    {
        return is_numeric($val) && floor($val) != $val;
    }

    public function productsCounter(Request $request)
    {
        $products = Db::table('product_storehouses')->where('product_storehouse_has_storehouses', $request->storehouseId)->where('product_storehouse_has_products', $request->productId)->count();

        return $products;
    }

    public function filterBy($filter)
    {
        return $filter;
    }

    public function showBy($storehouseSelectedId, $categorySelectedId, ?int $productSelectedId = 0, ?int $searchProductId = 0, ?int $offset = 0)
    {
        $fillWheres = '';

        $catWhere = "WHERE categories.id = " .  $categorySelectedId;
        $storeWhere = "WHERE storehouses.id = " . $storehouseSelectedId;
        $andWhere = "AND categories.id = " . $categorySelectedId;
        $andSearchWhere = "AND products.id = " . $searchProductId;
        $searchWhere = "WHERE products.id = " . $searchProductId;

        if ($storehouseSelectedId == 0 && $categorySelectedId != 0 && $searchProductId == 0) {
            $fillWheres = $catWhere;
        } elseif ($storehouseSelectedId != 0 && $categorySelectedId == 0 && $searchProductId == 0) {
            $fillWheres = $storeWhere;
        } elseif ($categorySelectedId != 0 && $storehouseSelectedId != 0 && $searchProductId == 0) {
            $fillWheres = $storeWhere . ' ' . $andWhere;
        } elseif ($storehouseSelectedId == 0 && $categorySelectedId != 0 && $searchProductId != 0) {
            $fillWheres = $catWhere  . ' ' .  $andSearchWhere;
        } elseif ($storehouseSelectedId != 0 && $categorySelectedId == 0 && $searchProductId != 0) {
            $fillWheres = $storeWhere  . ' ' .  $andSearchWhere;
        } elseif ($categorySelectedId != 0 && $storehouseSelectedId != 0 && $searchProductId != 0) {
            $fillWheres = $storeWhere  . ' ' .  $andWhere . ' ' . $andSearchWhere;
        } else {
            $fillWheres = $searchWhere;
        }

        $filtered = Db::select("SELECT products.product_has_category AS id, storehouses.name AS name, storehouses.prefix AS prefix, storehouses.description AS description, products.id AS pid, products.name AS pname, products.price AS pprice, products.prefix AS pprefix, categories.name AS pcategory, product_storehouses.product_storehouse_has_products, product_storehouses.product_storehouse_has_storehouses, COUNT(*) as total FROM storehouses
        INNER JOIN product_storehouses ON product_storehouses.product_storehouse_has_storehouses = storehouses.id
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN categories ON categories.id = products.product_has_category
        $fillWheres GROUP BY product_storehouses.product_storehouse_has_products, product_storehouses.product_storehouse_has_storehouses, products.product_has_category, storehouses.name, storehouses.prefix, storehouses.description, products.id, products.name, products.price, products.prefix, categories.name");

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
