<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\Order;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CustomerOrderingFlowTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function customer_can_view_menu_and_place_an_order(): void
    {
        $product = Product::factory()->create(['is_available' => true, 'price' => 25000]);
        
        $this->get(route('customer.menu.index'))->assertOk()->assertSee($product->name);
        $this->post(route('customer.cart.add', $product));

        $response = $this->post(route('customer.order.store'), [
            'customer_name' => 'Budi',
            'customer_phone' => '081234567890'
        ]);

        $this->assertDatabaseHas('orders', ['customer_name' => 'Budi', 'total_price' => 25000]);
        $order = Order::first();
        $response->assertRedirect(route('customer.order.success', $order));
        $this->assertEmpty(session('cart'));
    }
}