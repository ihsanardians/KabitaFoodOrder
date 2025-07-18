<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name(),
            'customer_phone' => $this->faker->numerify('08##########'),
            'queue_number' => $this->faker->numberBetween(1, 100),
            'total_price' => $this->faker->numberBetween(25000, 200000),
            'status' => 'diproses',
        ];
    }
}