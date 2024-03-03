<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class GeneralApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Db::select("SELECT products.id, products.name AS pname, products.prefix AS pprefix, products.price AS pprice, products.description AS pdescription, products.observations AS pobservations, categories.name AS cname, sum(t.stock) AS stockTotal, GROUP_CONCAT(DISTINCT images.filename) AS imageFilename
        FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY item_has_product_storehouses ORDER BY updated_at DESC) AS rownumber FROM items) t
        INNER JOIN product_storehouses ON product_storehouses.id = t.item_has_product_storehouses
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN storehouses ON storehouses.id = product_storehouses.product_storehouse_has_storehouses
        INNER JOIN categories ON categories.id = products.product_has_category
        LEFT JOIN images ON products.id = images.image_has_product
        WHERE t.rownumber = 1
        GROUP BY products.id;");

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
