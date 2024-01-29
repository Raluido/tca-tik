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

    public function addToStoreHouseForm()
    {
        $storehouses = Storehouse::all();

        $products = Product::all();

        return view('management.addToStorehouseForm', ['storehouses' => $storehouses, 'products' => $products]);
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

        $categories = Category::all();

        if ($storehouseSelectedId == 0 && $categorySelectedId != 0) {
            $filtered = Db::table('storehouses')
                ->select('products.product_has_category as id', 'storehouses.name as name', 'storehouses.prefix as prefix', 'storehouses.description as description', 'products.id as pid', 'products.name as pname',  'products.price as pprice', 'products.prefix as pprefix', 'categories.name as pcategory')
                ->join('product_storehouses', 'storehouses.id', '=', 'product_storehouses.product_storehouse_has_storehouses')
                ->join('products', 'products.id', '=', 'product_storehouses.product_storehouse_has_products')
                ->join('categories', 'categories.id', '=', 'products.product_has_category')
                ->where('categories.id', '=', $categorySelectedId)
                ->orderBy('categories.id')
                ->get();
        } elseif ($categorySelectedId == 0 && $storehouseSelectedId != 0) {
            $filtered = Db::table('storehouses')
                ->select('products.product_has_category as id', 'storehouses.name as name', 'storehouses.prefix as prefix', 'storehouses.description as description', 'products.id as pid', 'products.name as pname',  'products.price as pprice', 'products.prefix as pprefix', 'categories.name as pcategory')
                ->join('product_storehouses', 'storehouses.id', '=', 'product_storehouses.product_storehouse_has_storehouses')
                ->join('products', 'products.id', '=', 'product_storehouses.product_storehouse_has_products')
                ->join('categories', 'categories.id', '=', 'products.product_has_category')
                ->where('storehouses.id', '=', $storehouseSelectedId)
                ->orderBy('categories.id')
                ->get();
        } else {
            $filtered = Db::table('storehouses')
                ->select('products.product_has_category as id', 'storehouses.name as name', 'storehouses.prefix as prefix', 'storehouses.description as description', 'products.id as pid', 'products.name as pname',  'products.price as pprice', 'products.prefix as pprefix', 'categories.name as pcategory')
                ->join('product_storehouses', 'storehouses.id', '=', 'product_storehouses.product_storehouse_has_storehouses')
                ->join('products', 'products.id', '=', 'product_storehouses.product_storehouse_has_products')
                ->join('categories', 'categories.id', '=', 'products.product_has_category')
                ->where('storehouses.id', '=', $storehouseSelectedId)
                ->where('categories.id', '=', $categorySelectedId)
                ->orderBy('categories.id')
                ->get();
        }

        log::info($filtered);

        return view('management.showByFiltered', ['filtered' => $filtered, 'storehouses' => $storehouses, 'categories' => $categories, 'storehouseSelectedId' => $storehouseSelectedId, 'categorySelectedId' => $categorySelectedId]);
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

        return true;
    }

    public function removeFromStorehouse(Storehouse $storehouse, Product $product)
    {
        $delete = Db::table('product_storehouses')->where('product_storehouse_has_products', $product->id)->where('product_storehouse_has_storehouses', $storehouse->id)->latest('updated_at');

        $delete->delete();

        return redirect()->back()->withSuccess("Hemos eliminado una unidad del almacén");
    }
}
