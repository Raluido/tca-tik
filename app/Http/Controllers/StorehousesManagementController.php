<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storehouse;
use App\Models\Product;
use App\Models\Category;
use App\Models\Product_storehouse;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StorehousesManagementController extends Controller
{
    public function showBackOfficeAll()
    {
        $categories = Category::all();
        $storehouses = Storehouse::all();
        $products = Product::all();

        return view('backoffice.management.showProducts', ['storehouses' => $storehouses, 'categories' => $categories, 'products' => $products]);
    }

    public function showAllAjax($searchProductId = 0, $offset = 0, $historic = 'false')
    {
        if ($searchProductId != 0) {
            $searchWhere = " AND products.id = " . $searchProductId;
        } else {
            $searchWhere = '';
        }

        if ($historic == 'false') {

            $countAllProducts = Item::count();
            [$pagination, $totalPrd] = $this->paginator($countAllProducts);
            $productsAll = Db::select("SELECT storehouses.name AS sname, storehouses.prefix AS sprefix, products.prefix AS pprefix, products.name AS pname, products.price AS pprice, categories.name AS cname, items.updated_at, items.stock FROM items
            INNER JOIN product_storehouses ON product_storehouses.id = items.item_has_product_storehouses
            INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
            INNER JOIN storehouses ON storehouses.id = product_storehouses.product_storehouse_has_storehouses
            INNER JOIN categories ON categories.id = products.product_has_category
            $searchWhere GROUP BY storehouses.name, storehouses.prefix, products.prefix, products.name, products.price, categories.name, items.updated_at, items.stock ORDER BY storehouses.name, items.updated_at DESC LIMIT 10 OFFSET $offset");
        } elseif ($historic == 'true') {

            $productsAll = Db::select("SELECT storehouses.prefix AS sprefix, storehouses.name AS sname, products.prefix AS pprefix, products.name AS pname, products.price AS pprice, categories.name AS cname, t.stock, t.updated_at FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY item_has_product_storehouses ORDER BY updated_at DESC) AS rowNumber FROM items) t
            INNER JOIN product_storehouses ON product_storehouses.id = t.item_has_product_storehouses
            INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
            INNER JOIN storehouses ON storehouses.id = product_storehouses.product_storehouse_has_storehouses
            INNER JOIN categories ON categories.id = products.product_has_category
            WHERE t.rowNumber = 1 
            $searchWhere");

            [$pagination, $totalPrd] = $this->paginator(count($productsAll));

            $productsAll = Db::select("SELECT storehouses.prefix AS sprefix, storehouses.name AS sname, products.prefix AS pprefix, products.name AS pname, products.price AS pprice, categories.name AS cname, t.stock, t.updated_at FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY item_has_product_storehouses ORDER BY updated_at DESC) AS rowNumber FROM items) t
            INNER JOIN product_storehouses ON product_storehouses.id = t.item_has_product_storehouses
            INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
            INNER JOIN storehouses ON storehouses.id = product_storehouses.product_storehouse_has_storehouses
            INNER JOIN categories ON categories.id = products.product_has_category
            WHERE t.rowNumber = 1 
            $searchWhere GROUP BY storehouses.name, storehouses.prefix, products.prefix, products.name, products.price, categories.name, t.updated_at, t.stock 
            ORDER BY storehouses.name, t.updated_at DESC LIMIT 10 OFFSET $offset");
        }

        return ['productsAll' => $productsAll, 'search' => $searchProductId, 'pagination' => $pagination, 'offset' => $offset, 'totalPrd' => $totalPrd];
    }

    public function showFilteredAjax($storehouseSelectedId = 0, $categorySelectedId = 0, $searchProductId = 0, $offset = 0)
    {
        $fillWheres = '';

        $storeAnd = "AND storehouses.id = " . $storehouseSelectedId;
        $catAnd = "AND categories.id = " . $categorySelectedId;
        $searchAnd = "AND products.id = " . $searchProductId;

        if ($storehouseSelectedId == 0 && $categorySelectedId != 0 && $searchProductId == 0) {
            $fillWheres = $catAnd;
        } elseif ($storehouseSelectedId != 0 && $categorySelectedId == 0 && $searchProductId == 0) {
            $fillWheres = $storeAnd;
        } elseif ($categorySelectedId != 0 && $storehouseSelectedId != 0 && $searchProductId == 0) {
            $fillWheres = $storeAnd . ' ' . $catAnd;
        } elseif ($storehouseSelectedId == 0 && $categorySelectedId != 0 && $searchProductId != 0) {
            $fillWheres = $catAnd  . ' ' .  $searchAnd;
        } elseif ($storehouseSelectedId != 0 && $categorySelectedId == 0 && $searchProductId != 0) {
            $fillWheres = $storeAnd  . ' ' .  $searchAnd;
        } elseif ($categorySelectedId != 0 && $storehouseSelectedId != 0 && $searchProductId != 0) {
            $fillWheres = $storeAnd  . ' ' .  $catAnd . ' ' . $searchAnd;
        } elseif ($categorySelectedId == 0 && $storehouseSelectedId == 0 && $searchProductId != 0) {
            $fillWheres = $searchAnd;
        }

        if ($fillWheres != '') {

            $filtered = Db::select("SELECT * FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY item_has_product_storehouses ORDER BY updated_at DESC) AS rowNumber FROM items) t
            INNER JOIN product_storehouses ON product_storehouses.id = t.item_has_product_storehouses
            INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
            INNER JOIN storehouses ON storehouses.id = product_storehouses.product_storehouse_has_storehouses
            INNER JOIN categories ON categories.id = products.product_has_category
            WHERE t.rowNumber = 1
            $fillWheres;");

            [$pagination, $totalPrd] = $this->paginator(count($filtered));

            $filtered = Db::select("SELECT storehouses.prefix AS sprefix, storehouses.sname, storehouses.description AS sdescription, storehouses.prefix AS pprefix, storehouses.name AS pname, categories.name AS cname, products.price AS pprice, t.updated_at, t.stock FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY item_has_product_storehouses ORDER BY updated_at DESC) AS rowNumber FROM items) t
            INNER JOIN product_storehouses ON product_storehouses.id = t.item_has_product_storehouses
            INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
            INNER JOIN storehouses ON storehouses.id = product_storehouses.product_storehouse_has_storehouses
            INNER JOIN categories ON categories.id = products.product_has_category
            WHERE t.rowNumber = 1 
            $fillWheres LIMIT 10 OFFSET $offset");
        }

        return ['filtered' => $filtered, 'pagination' => $pagination, 'searchProductId' => $searchProductId, 'offset' => $offset, 'totalPrd' => $totalPrd];
    }

    function is_decimal($val)
    {
        return is_numeric($val) && floor($val) != $val;
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

    public function searchBackOfficeByProduct($inputSearch = '')
    {
        if ($inputSearch != '') {
            $productFiltered = Product::where('products.name', 'LIKE', '%' . $inputSearch . '%')
                ->get();
        } else {
            $productFiltered = null;
        }

        return $productFiltered;
    }

    public function backOfficeAddToStorehouse(Request $request)
    {
        $itemId = Product_storehouse::where('product_storehouse_has_storehouses', $request->storehouse)
            ->where('product_storehouse_has_products', $request->product)
            ->value('id');

        $latest = Db::table('items')
            ->where('item_has_product_storehouses', $itemId)
            ->orderBy('updated_at', 'desc')
            ->take('1')
            ->get();

        Item::create(['item_has_product_storehouses' => $itemId, 'action' => $request->action, 'pricepu' => $request->price, 'quantity' =>  $request->quantity, 'stock' => ($latest[0]->stock + $request->quantity)]);

        return true;
    }

    // public function backOfficeRemoveFromStorehouse(Storehouse $storehouse, Product $product)
    // {
    //     Db::table('product_storehouses')->where('product_storehouse_has_products', $product->id)->where('product_storehouse_has_storehouses', $storehouse->id)->orderBy('id')->limit(1)->delete();

    //     $productCount = Db::table('product_storehouses')->where('product_storehouse_has_storehouses', $storehouse->id)->where('product_storehouse_has_products', $product->id)->count();

    //     return [$productCount, $product->id];
    // }
}
