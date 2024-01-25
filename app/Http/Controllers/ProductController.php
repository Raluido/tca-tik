<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{
    public function showall()
    {
        $products = Product::all();

        return view('products.showall', ['products' => $products]);
    }

    public function createForm()
    {
        $categories = Category::all();

        if(count($categories) == 0) return redirect()->back()->withErrors('Para crear un artículo primero debe hacer creado al menos una categoría.');

        return view('products.createForm', ['categories' => $categories]);
    }

    public function create(CreateProductRequest $request)
    {
        $newProduct = Product::create($request->validated());
    }

    public function editForm(Product $product)
    {
        $categories = Category::all();

        return view('products.editForm', ['categories' => $categories, 'product' => $product]);
    }

    public function edit(CreateProductRequest $request)
    {
        $editProduct = Product::where('id', $request->id)->update($request->validated());

        return redirect()->back()->withSuccess('El producto se ha actulizado correctamente.');
    }

    public function delete(Product $product)
    {
        Product::where('id', $product->id)->delete();

        return redirect()->back()->withSuccess('El producto se ha eliminado correctamente');
    }
}
