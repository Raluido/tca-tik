<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storehouse;
use App\Http\Requests\CreateStorehouseRequest;
use App\Models\Product_storehouse;
use App\Models\Product;
use App\Models\Item;
use Illuminate\Support\Facades\Log;

class StorehouseController extends Controller
{
    public function showBackOfficeAll()
    {
        $storehouses = Storehouse::paginate(10);

        return view('backoffice.storehouses.showall', ['storehouses' => $storehouses]);
    }

    public function showBackOfficeCreate()
    {
        return view('backoffice.storehouses.createForm');
    }

    public function backOfficeStore(CreateStorehouseRequest $request)
    {
        $storehouse = Storehouse::create($request->validated());

        $products = Product::all();
        if (isset($products) && count($products) != 0) {
            foreach ($products as $key => $value) {
                $productStorehouse = Product_storehouse::create([
                    'product_storehouse_has_products' => $value->id,
                    'product_storehouse_has_storehouses' => $storehouse->id
                ]);

                log::info($productStorehouse->id);

                Item::create([
                    'item_has_product_storehouses' => $productStorehouse->id,
                    'action' => 'init',
                    'pricepu' => 0,
                    'quantity' => 0,
                    'stock' => 0
                ]);
            }
        }

        return redirect()->back()->withSuccess('El almacén se ha creado correctamente.');
    }

    public function showBackOfficeEdit(Storehouse $storehouse)
    {
        return view('backoffice.storehouses.editForm', ['storehouse' => $storehouse]);
    }

    public function backOfficeUpdate(CreateStorehouseRequest $request, Storehouse $storehouse)
    {
        $update = Storehouse::find($storehouse->id);

        $update->update($request->validated());

        return redirect()->back()->withSuccess('El almacén se ha actulizado correctamente.');
    }

    public function backOfficeDestroy(Storehouse $storehouse)
    {
        Product_storehouse::where('product_storehouse_has_storehouses', $storehouse->id)->delete();

        Storehouse::find($storehouse->id)->delete();

        return redirect()->back()->withSuccess('El almacén se ha eliminado correctamente');
    }
}
