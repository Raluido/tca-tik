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
    public function showall()
    {
        $storehouses = Storehouse::all();

        $categories = Category::all();

        return view('management.showall', ['storehouses' => $storehouses, 'categories' => $categories]);
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

    public function showBy($storehouseSelectedId, $categorySelectedId, $productSelectedId = 0, $searchProductId = '')
    {
        $storehouses = Storehouse::all();

        $products = Product::all();

        $categories = Category::all();

        $fillWheres = '';

        $catWhere = "WHERE categories.id = " .  $categorySelectedId;
        $storeWhere = "WHERE storehouses.id = " . $storehouseSelectedId;
        $andWhere = "AND categories.id = " . $categorySelectedId;
        $andSearchWhere = "AND products.id = " . $searchProductId;

        if ($storehouseSelectedId == 0 && $categorySelectedId != 0 && $searchProductId == '') {
            $fillWheres = $catWhere;
        } elseif ($storehouseSelectedId != 0 && $categorySelectedId == 0 && $searchProductId == '') {
            $fillWheres = $storeWhere;
        } elseif ($categorySelectedId != 0 && $storehouseSelectedId != 0 && $searchProductId == '') {
            $fillWheres = $storeWhere . ' ' . $andWhere;
        } elseif ($storehouseSelectedId == 0 && $categorySelectedId != 0 && $searchProductId != '') {
            $fillWheres = $catWhere  . ' ' .  $andSearchWhere;
        } elseif ($storehouseSelectedId != 0 && $categorySelectedId == 0 && $searchProductId != '') {
            $fillWheres = $storeWhere  . ' ' .  $andSearchWhere;
        } elseif ($categorySelectedId != 0 && $storehouseSelectedId != 0 && $searchProductId != '') {
            $fillWheres = $storeWhere  . ' ' .  $andWhere . ' ' . $andSearchWhere;
        }

        $filtered = Db::select("SELECT products.product_has_category AS id, storehouses.name AS name, storehouses.prefix AS prefix, storehouses.description AS description, products.id AS pid, products.name AS pname, products.price AS pprice, products.prefix AS pprefix, categories.name AS pcategory FROM storehouses
        INNER JOIN product_storehouses ON product_storehouses.product_storehouse_has_storehouses = storehouses.id
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN categories ON categories.id = products.product_has_category
        $fillWheres");

        return view('management.showByFiltered', ['filtered' => $filtered, 'storehouses' => $storehouses, 'categories' => $categories, 'products' => $products, 'storehouseSelectedId' => $storehouseSelectedId, 'categorySelectedId' => $categorySelectedId, 'productSelectedId' => $productSelectedId]);
    }

    public function searchByProduct($inputSearch)
    {
        $productFiltered = Db::table('products')
            ->select('products.id', 'products.name')
            ->where('products.name', 'LIKE', '%' . $inputSearch . '%')
            ->get();

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
        $delete = Db::table('product_storehouses')->where('product_storehouse_has_products', $product->id)->where('product_storehouse_has_storehouses', $storehouse->id)->orderBy('id')->limit(1)->delete();

        $productCount = Db::table('product_storehouses')->where('product_storehouse_has_storehouses', $storehouse->id)->where('product_storehouse_has_products', $product->id)->count();

        return [$productCount, $product->id];
    }
}
