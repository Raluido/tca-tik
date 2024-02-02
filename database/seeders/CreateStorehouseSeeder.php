<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Storehouse;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Factories\Sequence;

class CreateStorehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()
            ->count(6)
            ->create();

        $products = Product::factory()
            ->count(50)
            ->state(new Sequence(
                ['product_has_category' => 1],
                ['product_has_category' => 2],
                ['product_has_category' => 3],
                ['product_has_category' => 4],
                ['product_has_category' => 5],
                ['product_has_category' => 6],
            ))
            ->create();

        Storehouse::factory()
            ->count(5)
            ->hasAttached($products)
            ->create();
    }
}
