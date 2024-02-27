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
use App\Models\User;
use App\Models\Cart;
use ArrayObject;
use Illuminate\Support\Facades\DB;
use Faker\Extension\FileExtension;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp;

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
                $fileName = 'id_' . $product->id . '_' . time() . '.' . $extension;
                $image->storeAs('images/' . $fileName);
                $imageObj[] = new Image([
                    'filename' => $fileName
                ]);
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
                    'pricepu' => 0,
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

        $validated = $request->validated();
        $images = $validated['images'];
        $imageObj = array();

        $update->update($validated);

        if (count($images) > 0) {
            foreach ($images as $key => $image) {
                $extension = $image->getClientOriginalExtension();
                $fileName = 'id_' . $product->id . '_' . time() . '.' . $extension;
                $image->storeAs('images/' . $fileName);
                $imageObj[] = new Image([
                    'filename' => $fileName
                ]);
            }
            $update->images()->saveMany($imageObj);
        }

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

    public function showProduct(Product $product)
    {
        $product = Db::select("SELECT products.name AS pname, products.description AS pdescription, products.price AS pprice, 
        products.prefix AS pprefix, products.id, SUM(t.stock) AS totalStock, GROUP_CONCAT(DISTINCT images.filename) 
        AS images FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY items.item_has_product_storehouses ORDER BY updated_at DESC) AS rownumber FROM items) t
        INNER JOIN product_storehouses ON product_storehouses.id = t.item_has_product_storehouses
        INNER JOIN products ON products.id = product_storehouses.product_storehouse_has_products
        INNER JOIN categories ON categories.id = products.product_has_category
        LEFT JOIN images ON products.id = images.image_has_product
        WHERE rownumber = 1 AND products.id = $product->id GROUP BY products.id");

        $product = $product[0];

        return view('product.product', ['product' => $product]);
    }

    public function addToCart(Product $product, $quantity)
    {
        $cartList = array();
        $added = false;

        if (session()->has('cartList')) {
            $sessionId = session()->getId();
            $cartList = session("cartList");
            foreach ($cartList as $cartItem) {
                if ($cartItem['id'] == $product->id) {
                    $cartItem['quantity'] += $quantity;
                    Cart::where('session_id', $sessionId)->where('cart_has_products', $product->id)->increase('quantity', $quantity);
                    $added = true;
                }
            }
        } else {
            $cartList = [];
        }

        if (!$added) {
            $temp = array(
                'id' => $product->id,
                'quantity' => 0
            );
            $cartList[] = $temp;
            Cart::create([
                'cart_has_products' => $product->id,
                'session_id' => $sessionId,
                'quantity' => $quantity
            ]);
        }

        session()->forget('cartList');
        session(['cartList' => $cartList]);

        return end($cartList)['quantity'];
    }

    public function removeFromCart(Product $product, $quantity)
    {
        $sessionId = session()->getId();

        if (session()->has('cartList')) {
            $cartList = session("cartList");
            foreach ($cartList as $key => $cartItem) {
                if ($cartItem['id'] == $product->id) {
                    $cartItem['quantity'] += $quantity;
                    Cart::where('cart_has_products', $product->id)->where('session_id', $sessionId)->decrease('quantity', $quantity);
                }
                if ($cartItem['quantity'] == 0) {
                    unset($cartList[$key]);
                    Cart::where('cart_has_products', $product->id)->where('session_id', $sessionId)->delete();
                }
            }
        }

        session()->forget('cartList');

        if (count($cartList) != 0) session(['cartList' => $cartList]);

        return end($cartList)['quantity'];
    }

    public function showCart()
    {
        if (session()->has('cartList')) {
            $cartList = session("cartList");
            $products = array();
            foreach ($cartList as $cartItem) {
                $result = Db::select("SELECT products.id, products.name, products.description, products.price, GROUP_CONCAT(DISTINCT images.filename) AS images FROM products
                LEFT JOIN images ON images.image_has_product = products.id
                WHERE products.id = $cartItem[id] 
                GROUP BY products.id, products.name, products.description, products.price LIMIT 1;");

                $products[] = $result[0];

                end($products)->quantity = $cartItem['quantity'];
            }
        } else {
            $products = "El carro está vacío!";
        }

        return view('product.showCart', ['products' => $products]);
    }

    public function distanceClientStorehouses()
    {
        $clientStorehouses = array();
        $destination = '';
        $storehouseDistanceBefore = 0;
        $storehouses = Storehouse::all();
        $userAddresses = User::find(auth()->id())->addresses;

        foreach ($userAddresses as $key => $value) {
            if ($value->shipping_address_slc) $destination = $value->address . ',' . $value->zipcode . ',' . $value->country;
            else return redirect()->back()->withErrors("Ha habido un error con la dirección de envío, consulte al administrador");
            continue;
        }

        if ($destination) {
            foreach ($storehouses as $storehouse) {
                $storehouseDistance = new ArrayObject([
                    'id' => $storehouse->id,
                    'distance' => $this->getDistance($storehouse->address, $destination)
                ]);
                if ($storehouseDistance['distance'] < $storehouseDistanceBefore) {
                    array_unshift($clientStorehouses, $storehouseDistance);
                } else {
                    array_push($clientStorehouses, $storehouseDistance);
                    $storehouseDistanceBefore = $storehouseDistance['distance'];
                }
            }
        } else {
            return redirect()->back()->withErrors("Ha habido un error con la dirección de envío, consulte al administrador");
        }

        return $clientStorehouses;
    }

    public function getDistance($origin, $destination)
    {
        $key = '5ZCPy75ETZGM6gZvtRyiY5OKB7uAnhrkJh9QM7AeywcHP3YnHxnh4Ic1B6idSCR3';
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', "https://api.distancematrix.ai/maps/api/distancematrix/json?origins=" . $origin . "&destinations=" . $destination . "&key=" . $key);

        if ($res->getStatusCode() == 200) {
            $distance = json_decode($res->getBody(), true)['rows'][0]['elements'][0]['distance']['value'];
        }

        return $distance;
    }
}
