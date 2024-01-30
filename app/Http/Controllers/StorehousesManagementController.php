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

    public function showBy($storehouseSelectedId, $categorySelectedId)
    {
        $storehouses = Storehouse::all();

        $products = Product::all();

        $categories = Category::all();

        if ($storehouseSelectedId == 0 && $categorySelectedId != 0) {
            $filtered = Db::table('storehouses')
                ->select('products.product_has_category as id', 'storehouses.name as name', 'storehouses.prefix as prefix', 'storehouses.description as description', 'products.id as pid', 'products.name as pname',  'products.price as pprice', 'products.prefix as pprefix', 'categories.name as pcategory')
                ->join('product_storehouses', 'storehouses.id', '=', 'product_storehouses.product_storehouse_has_storehouses')
                ->join('products', 'products.id', '=', 'product_storehouses.product_storehouse_has_products')
                ->join('categories', 'categories.id', '=', 'products.product_has_category')
                ->where('categories.id', '=', $categorySelectedId)
                ->orderBy('products.id')
                ->get();
        } elseif ($categorySelectedId == 0 && $storehouseSelectedId != 0) {
            $filtered = Db::table('storehouses')
                ->select('products.product_has_category as id', 'storehouses.name as name', 'storehouses.prefix as prefix', 'storehouses.description as description', 'products.id as pid', 'products.name as pname',  'products.price as pprice', 'products.prefix as pprefix', 'categories.name as pcategory')
                ->join('product_storehouses', 'storehouses.id', '=', 'product_storehouses.product_storehouse_has_storehouses')
                ->join('products', 'products.id', '=', 'product_storehouses.product_storehouse_has_products')
                ->join('categories', 'categories.id', '=', 'products.product_has_category')
                ->where('storehouses.id', '=', $storehouseSelectedId)
                ->orderBy('products.id')
                ->get();
        } else {
            $filtered = Db::table('storehouses')
                ->select('products.product_has_category as id', 'storehouses.name as name', 'storehouses.prefix as prefix', 'storehouses.description as description', 'products.id as pid', 'products.name as pname',  'products.price as pprice', 'products.prefix as pprefix', 'categories.name as pcategory')
                ->join('product_storehouses', 'storehouses.id', '=', 'product_storehouses.product_storehouse_has_storehouses')
                ->join('products', 'products.id', '=', 'product_storehouses.product_storehouse_has_products')
                ->join('categories', 'categories.id', '=', 'products.product_has_category')
                ->where('storehouses.id', '=', $storehouseSelectedId)
                ->where('categories.id', '=', $categorySelectedId)
                ->orderBy('products.id')
                ->get();
        }

        return view('management.showByFiltered', ['filtered' => $filtered, 'storehouses' => $storehouses, 'categories' => $categories, 'products' => $products, 'storehouseSelectedId' => $storehouseSelectedId, 'categorySelectedId' => $categorySelectedId]);
    }

    public function searchByProduct($storehouseSelectedId, $categorySelectedId, $inputSearch)
    {
        $product = Db::table('storehouses')
            ->select('products.product_has_category as id', 'storehouses.name as name', 'storehouses.prefix as prefix', 'storehouses.description as description', 'products.id as pid', 'products.name as pname',  'products.price as pprice', 'products.prefix as pprefix', 'categories.name as pcategory')
            ->join('product_storehouses', 'storehouses.id', '=', 'product_storehouses.product_storehouse_has_storehouses')
            ->join('products', 'products.id', '=', 'product_storehouses.product_storehouse_has_products')
            ->join('categories', 'categories.id', '=', 'products.product_has_category')
            ->where('storehouses.id', '=', $storehouseSelectedId)
            ->where('categories.id', '=', $categorySelectedId)
            ->where('products.name', 'LIKE', '%' . $inputSearch . '%')
            ->orderBy('categories.id')
            ->get();
    }

    public function addToStorehouse($storehouse, $product)
    {
        Product_storehouse::create(['product_storehouse_has_products' => $product, 'product_storehouse_has_storehouses' => $storehouse]);

        $products = Db::table('product_storehouses')->where('product_storehouse_has_storehouses', $storehouse)->where('product_storehouse_has_products', $product)->count();

        return $products;
    }

    public function removeFromStorehouse(Storehouse $storehouse, Product $product)
    {
        $delete = Db::table('product_storehouses')->where('product_storehouse_has_products', $product->id)->where('product_storehouse_has_storehouses', $storehouse->id)->orderBy('id')->limit(1)->delete();

        $products = Db::table('product_storehouses')->where('product_storehouse_has_storehouses', $storehouse->id)->where('product_storehouse_has_products', $product->id)->count();

        return $products;
    }
}
