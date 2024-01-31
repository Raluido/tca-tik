<?php

namespace Database\Factories;

use App\Models\Storehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\es_ES\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Storehouse>
 */
class StorehouseFactory extends Factory
{
    protected $model = Storehouse::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->paragraph(),
            'address' => fake()->address(),
            'prefix' => fake()->word(3)
        ];
    }
}
