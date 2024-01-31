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
        return view('categories.editForm', ['category' => $category]);
    }

    public function edit(CreateCategoryRequest $request, Category $category)
    {
        $update = Category::find($category->id);

        $update->update($request->validated());

        return redirect()->back()->withSuccess('La categoría se ha actualizado correctamente.');
    }

    public function delete(Category $category)
    {
        $delete = Category::find($category->id);

        $delete->delete();

        return redirect()->back()->withSuccess('La categoría se ha eliminado correctamente');
    }
}
