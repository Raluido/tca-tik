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

    public function addProductForm()
    {
        $storehouses = Storehouse::all();

        $products = Product::all();

        return view('management.addToStorehouseForm', ['storehouses' => $storehouses, 'products' => $products]);
    }

    public function filterByStorehouse($storehouseSelected)
    {
        return $storehouseSelected;
    }

    public function showByStorehouse($storehouseSelectedId, $categorySelectedId)
    {
        $storehouses = Storehouse::all();

        $categories = Category::all();

        $storehouseSelected = Storehouse::find($storehouseSelectedId);

        return view('management.showByStorehouse', ['storehouseSelected' => $storehouseSelected, 'storehouses' => $storehouses, 'categories' => $categories, 'storehouseSelectedId' => $storehouseSelectedId, 'categorySelectedId' => $categorySelectedId]);
    }

    public function showByCategory($categorySelectedId, $storehouseSelectedId)
    {
        $storehouses = Storehouse::all();

        $categories = Category::all();

        $categorySelected = Db::table('storehouses')
            ->select('products.product_has_category as id', 'storehouses.name as name', 'storehouses.prefix as prefix', 'storehouses.description as description', 'products.id as pid', 'products.name as pname',  'products.price as pprice', 'products.prefix as pprefix', 'categories.name as pcategory')
            ->join('product_storehouses', 'storehouses.id', '=', 'product_storehouses.product_storehouse_has_storehouses')
            ->join('products', 'products.id', '=', 'product_storehouses.product_storehouse_has_products')
            ->join('categories', 'categories.id', '=', 'products.product_has_category')
            ->where('categories.id', '=', $categorySelectedId)
            ->get();

        return view('management.showByCat', ['categorySelected' => $categorySelected, 'storehouses' => $storehouses, 'categories' => $categories, 'storehouseSelectedId' => $storehouseSelectedId, 'categorySelectedId' => $categorySelectedId]);
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
