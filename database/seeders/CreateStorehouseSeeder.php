<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Storehouse;
use App\Models\Category;

class CreateStorehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory()
            ->count(25)
            ->for(Category::factory()->create())
            ->create();

        Storehouse::factory(5)
            ->hasAttached($products)
            ->create();
    }
}
