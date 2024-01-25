<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function showall()
    {
        $categories = Category::all();

        return view('categories.showall', ['categories' => $categories]);
    }

    public function createForm()
    {
        return view('categories.createForm');
    }

    public function create(CreateCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->back()->withSuccess('La categoría se ha creado correctamente!!');
    }

    public function editForm(Category $category)
    {
        $categories = Category::all();

        return view('categories.createForm', ['category' => $category]);
    }

    public function edit(CreateCategoryRequest $request)
    {
        $editcategory = Category::where('id', $request->id)->update($request->validated());

        return redirect()->back()->withSuccess('La categoría se ha actulizado correctamente.');
    }

    public function delete(Category $category)
    {
        category::where('id', $category->id)->delete();

        return redirect()->back()->withSuccess('La categoría se ha eliminado correctamente');
    }
}
