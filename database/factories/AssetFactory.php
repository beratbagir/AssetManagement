<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\Licence;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'asset_name' => $this->faker->word . ' ' . $this->faker->randomElement(['Laptop', 'Phone', 'Tablet', 'Monitor']),
            'product_id' => Product::inRandomOrder()->first()->product_id, 
            'licence_id' => Licence::inRandomOrder()->first()->licence_id,
            'serial_number' => $this->faker->unique()->word,
            'quantity' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['active', 'inactive', 'maintenance']),
            'assigned_to' => User::inRandomOrder()->first()->id, 
            'notes' => $this->faker->sentence,
        ];
    }
}
