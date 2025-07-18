<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'category' => $this->faker->randomElement(['Main Course', 'Dessert', 'Add On']),
            'price' => $this->faker->numberBetween(10000, 100000),
            'description' => $this->faker->sentence(),
            'image' => 'products/placeholder.jpg',
            'is_available' => true,
        ];
    }
}