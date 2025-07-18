<?php
namespace Database\Factories;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        $product = Product::factory()->create();
        return [
            'order_id' => Order::factory(),
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity' => $this->faker->numberBetween(1, 3),
            'price' => $product->price,
        ];
    }
}