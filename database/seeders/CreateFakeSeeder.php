<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Storehouse;
use App\Models\Category;
use App\Models\Item;
use App\Models\Product_storehouse;
use Illuminate\Database\Seeder;

class CreateFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'prefix' => 'PA',
            'name' => 'Pantalones',
            'description' => 'Sport y vestir'
        ]);

        Category::create([
            'prefix' => 'CA',
            'name' => 'Camisas',
            'description' => 'Sport y vestir'
        ]);

        Category::create([
            'prefix' => 'SU',
            'name' => 'Sudaderas',
            'description' => 'Sport y vestir'
        ]);

        Category::create([
            'prefix' => 'CAL',
            'name' => 'Calcetines',
            'description' => 'Sport y vestir'
        ]);

        Category::create([
            'prefix' => 'GOR',
            'name' => 'Gorras',
            'description' => 'Sport y vestir'
        ]);


        Product::create([
            'prefix' => 'CHB',
            'name' => 'Chino Beige',
            'product_has_category' => 1,
            'price' => 49.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Beige"
        ]);

        Product::create([
            'prefix' => 'CHB',
            'name' => 'Chino Marron',
            'product_has_category' => 1,
            'price' => 49.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Marron"
        ]);

        Product::create([
            'prefix' => 'CHB',
            'name' => 'Chino Azul',
            'product_has_category' => 1,
            'price' => 49.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Azul"
        ]);

        Product::create([
            'prefix' => 'ARI',
            'name' => 'Camisa Beige',
            'product_has_category' => 2,
            'price' => 49.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Beige"
        ]);

        Product::create([
            'prefix' => 'ARI',
            'name' => 'Camisa Marron',
            'product_has_category' => 2,
            'price' => 49.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Marron"
        ]);

        Product::create([
            'prefix' => 'ARI',
            'name' => 'Camisa Azul',
            'product_has_category' => 2,
            'price' => 49.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Azul"
        ]);

        Product::create([
            'prefix' => 'HUT',
            'name' => 'Sudadera Beige',
            'product_has_category' => 3,
            'price' => 69.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Beige"
        ]);

        Product::create([
            'prefix' => 'HUT',
            'name' => 'Sudadera Marron',
            'product_has_category' => 3,
            'price' => 69.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Marron"
        ]);

        Product::create([
            'prefix' => 'HUT',
            'name' => 'Sudadera Azul',
            'product_has_category' => 3,
            'price' => 69.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Azul"
        ]);

        Product::create([
            'prefix' => 'JIM',
            'name' => 'Calcetin Beige',
            'product_has_category' => 4,
            'price' => 9.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Beige"
        ]);

        Product::create([
            'prefix' => 'JIM',
            'name' => 'Calcetin Marron',
            'product_has_category' => 4,
            'price' => 9.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Marron"
        ]);

        Product::create([
            'prefix' => 'JIM',
            'name' => 'Calcetin Azul',
            'product_has_category' => 4,
            'price' => 9.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Azul"
        ]);

        Product::create([
            'prefix' => 'CAR',
            'name' => 'Gorra Beige',
            'product_has_category' => 5,
            'price' => 9.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Beige"
        ]);

        Product::create([
            'prefix' => 'CAR',
            'name' => 'Gorra Marron',
            'product_has_category' => 5,
            'price' => 9.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Marron"
        ]);

        Product::create([
            'prefix' => 'CAR',
            'name' => 'Gorra Azul',
            'product_has_category' => 5,
            'price' => 9.90,
            'tax' => 7.00,
            'observations' => 2023,
            'description' => "Azul"
        ]);

        $storehouse = Storehouse::create([
            'prefix' => "LLA",
            'name' => "La Laguna uno",
            'address' => "Calle sinNUmero",
            'description' => "Arica y The Brubaker"
        ]);

        $products = Product::all();
        if (isset($products) && count($products) != 0) {
            foreach ($products as $key => $value) {
                $productStorehouse = Product_storehouse::create([
                    'product_storehouse_has_products' => $value->id,
                    'product_storehouse_has_storehouses' => $storehouse->id
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

        $storehouse =  Storehouse::create([
            'prefix' => "SCU",
            'name' => "Santa Cruz",
            'address' => "Calle La viñita 13",
            'description' => "Hutton"
        ]);

        $products = Product::all();
        if (isset($products) && count($products) != 0) {
            foreach ($products as $key => $value) {
                $productStorehouse = Product_storehouse::create([
                    'product_storehouse_has_products' => $value->id,
                    'product_storehouse_has_storehouses' => $storehouse->id
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

        $storehouse = Storehouse::create([
            'prefix' => "LAO",
            'name' => "La Orotava",
            'address' => "Calle Calvario 5",
            'description' => "Oulet"
        ]);

        $products = Product::all();
        if (isset($products) && count($products) != 0) {
            foreach ($products as $key => $value) {
                $productStorehouse = Product_storehouse::create([
                    'product_storehouse_has_products' => $value->id,
                    'product_storehouse_has_storehouses' => $storehouse->id
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
    }
}
