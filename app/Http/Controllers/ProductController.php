<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Storehouse;
use App\Models\Product_storehouse;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function showall()
    {
        $products = Product::all();

        return view('products.showall', ['products' => $products]);
    }

    public function showone(Product $product)
    {
        $product = Product::find($product->id);

        return view('products.showone', ['product' => $product]);
    }

    public function createForm()
    {
        $categories = Category::all();

        $storehouses = Storehouse::all();

        if (count($categories) == 0 || is_null($categories)) return redirect()->back()->withErrors('Para crear un artículo primero debe haber creado al menos una categoría.');

        return view('products.createForm', ['categories' => $categories, 'storehouses' => $storehouses]);
    }

    public function create(CreateProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->back()->withSuccess('El producto se ha creado correctamente.');
    }

    public function editForm(Product $product)
    {
        $categories = Category::all();

        return view('products.editForm', ['categories' => $categories, 'product' => $product]);
    }

    public function edit(Product $product, CreateProductRequest $request)
    {
        $update = Product::find($product->id);

        $update->update($request->validated());

        return redirect()->back()->withSuccess('El producto se ha actulizado correctamente.');
    }

    public function delete(Product $product)
    {
        Product_storehouse::where('product_storehouse_has_products', $product->id)->delete();

        $delete = Product::find($product->id);

        $delete->delete();

        return $delete;
    }
}
