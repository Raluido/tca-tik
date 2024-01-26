<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storehouse;
use App\Http\Requests\CreateStorehouseRequest;

class StorehouseController extends Controller
{
    public function showall()
    {
        $storehouses = Storehouse::all();

        return view('storehouses.showall', ['storehouses' => $storehouses]);
    }

    public function createForm()
    {
        return view('storehouses.createForm');
    }

    public function create(CreateStorehouseRequest $request)
    {
        Storehouse::create($request->validated());

        return redirect()->back()->withSuccess('El almacén se ha creado correctamente.');
    }

    public function editForm(Storehouse $storehouse)
    {
        return view('storehouses.createForm', ['storehouse' => $storehouse]);
    }

    public function edit(CreateStorehouseRequest $request, Storehouse $storehouse)
    {
        $update = Storehouse::find($storehouse->id);

        $update->update($request->validated());

        return redirect()->back()->withSuccess('El almacén se ha actulizado correctamente.');
    }

    public function delete(Storehouse $storehouse)
    {
        $delete = Storehouse::find($storehouse->id);

        $delete->delete();

        return redirect()->back()->withSuccess('El almacén se ha eliminado correctamente');
    }
}
