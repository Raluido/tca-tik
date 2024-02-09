<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showBackOfficeAll()
    {
        $categories = Category::paginate(10);

        return view('backoffice.categories.showall', ['categories' => $categories]);
    }

    public function showBackOfficeCreate()
    {
        return view('backoffice.categories.createForm');
    }

    public function backOfficeStore(CreateCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->back()->withSuccess('La categoría se ha creado correctamente!!');
    }

    public function showBackOfficeEdit(Category $category)
    {
        return view('backoffice.categories.editForm', ['category' => $category]);
    }

    public function backOfficeUpdate(CreateCategoryRequest $request, Category $category)
    {
        $update = Category::find($category->id);

        $update->update($request->validated());

        return redirect()->back()->withSuccess('La categoría se ha actualizado correctamente.');
    }

    public function backOfficeDestroy(Category $category)
    {
        Db::table('product_storehouses')
            ->join('storehouses', 'storehouses.id', 'product_storehouses.product_storehouse_has_storehouses')
            ->join('products', 'products.id', 'product_storehouses.product_storehouse_has_products')
            ->where('product_has_category', $category->id)
            ->delete();

        Db::table('products')
            ->where('product_has_category', $category->id)
            ->delete();

        $delete = Category::find($category->id);

        $delete->delete();

        return redirect()->back()->withSuccess('La categoría se ha eliminado correctamente');
    }
}
