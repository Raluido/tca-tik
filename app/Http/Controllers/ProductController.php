<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Storehouse;
use App\Models\Product_storehouse;
use App\Http\Requests\CreateProductRequest;
use App\Models\Discount;
use App\Models\Image;
use App\Models\Item;
use Faker\Extension\FileExtension;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validated();
        $images = $validated['images'];
        $imageObj = array();

        $product = Product::create($validated);

        if (count($images) > 0) {
            foreach ($images as $key => $image) {
                $extension = $image->getClientOriginalExtension();
                $fileName = 'id_' . $product->id . '_' . $key . '.' . $extension;
                $image->storeAs('images/' . $fileName);
                $imageObj[] = [
                    'filename' => $fileName
                ];
            }
            $product->images()->createMany($imageObj);
        }

        $storehouses = Storehouse::all();
        if (isset($storehouses) && count($storehouses) != 0) {
            foreach ($storehouses as $key => $value) {
                $productStorehouse = Product_storehouse::create([
                    'product_storehouse_has_products' => $product->id,
                    'product_storehouse_has_storehouses' => $value->id
                ]);

                Item::create([
                    'item_has_product_storehouses' => $productStorehouse->id,
                    'action' => 'init',
                    'pricepu' => null,
                    'quantity' => 0,
                    'stock' => 0
                ]);
            }
        }

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

    public function backOfficeDestroyImg(Image $image)
    {
        if (Storage::exists('images/' . $image->filename)) {
            Storage::delete('images/' . $image->filename);
            Image::find($image->id)->delete();
        }

        return true;
    }
}
