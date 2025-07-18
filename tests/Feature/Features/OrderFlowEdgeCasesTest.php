<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrderFlowEdgeCasesTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_redirects_with_error_if_cart_is_empty_on_checkout(): void
    {
        // Pastikan session keranjang benar-benar kosong
        session()->forget('cart');

        $this->post(route('customer.order.store'), [
            'customer_name' => 'Tester',
            'customer_phone' => '081234567890'
        ])
        ->assertRedirect(route('customer.menu.index'))
        ->assertSessionHas('error', 'Keranjang Anda kosong!');
    }

    #[Test]
    public function accessing_a_non_existent_order_success_page_returns_404(): void
    {
        // Mencoba mengakses halaman sukses untuk order ID 999 yang tidak ada
        $this->get('/order/success/999')->assertNotFound();
    }
}