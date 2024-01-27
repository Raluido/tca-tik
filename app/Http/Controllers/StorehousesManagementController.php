<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storehouse;
use App\Models\Product;

class StorehousesManagementController extends Controller
{
    public function showall()
    {
        $storehouses = Storehouse::all();

        return view('management.showall', ['storehouses' => $storehouses]);
    }

    public function addProduct()
    {
        $storehouses = Storehouse::all();

        $products = Product::all();

        return view('management.addToStorehouseForm', ['storehouses' => $storehouses, 'products' => $products]);
    }
}
