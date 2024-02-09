<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Storehouse;
use App\Models\Product_storehouse;
use App\Http\Requests\CreateProductRequest;
use App\Models\Discount;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function showBackOfficeAll()
    {
        $products = Product::paginate(10);

        return view('backoffice.products.showall', ['products' => $products]);
    }

    public function showBackOfficeOne(Product $product)
    {
        $product = Product::find($product->id);

        return view('backoffice.products.showone', ['product' => $product]);
    }

    public function showBackOfficeCreate()
    {
        $categories = Category::all();
        $storehouses = Storehouse::all();
        $discounts = Discount::all();

        if (count($categories) == 0 || is_null($categories)) return redirect()->back()->withErrors('Para crear un artículo primero debe haber creado al menos una categoría.');

        return view('backoffice.products.createForm', ['categories' => $categories, 'storehouses' => $storehouses, 'discounts' => $discounts]);
    }

    public function backOfficeStore(CreateProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->back()->withSuccess('El producto se ha creado correctamente.');
    }

    public function showBackOfficeEdit(Product $product)
    {
        $categories = Category::all();

        return view('backoffice.products.editForm', ['categories' => $categories, 'product' => $product]);
    }

    public function backOfficeUpdate(Product $product, CreateProductRequest $request)
    {
        $update = Product::find($product->id);

        $update->update($request->validated());

        return redirect()->back()->withSuccess('El producto se ha actulizado correctamente.');
    }

    public function backOfficeDestroy(Product $product)
    {
        Product_storehouse::where('product_storehouse_has_products', $product->id)->delete();

        $delete = Product::find($product->id);

        $delete->delete();

        return $delete;
    }
}
