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
        $categories = Category::factory()
            ->count(5)
            ->has(Product::factory()->count(25))
            ->create();

        Storehouse::factory()
            ->count(5)
            ->hasAttached(Product::factory()->count(25))
            ->create();
    }
}
