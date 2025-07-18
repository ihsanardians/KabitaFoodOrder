<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Order;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminOrderStatusTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_can_complete_an_order(): void
    {
        $admin = User::factory()->create();
        $order = Order::factory()->create([
            'status' => 'diproses',
            'customer_phone' => '081234567890'
        ]);

        $response = $this->actingAs($admin)
            ->patch(route('admin.orders.updateStatus', $order));
        
        // 1. Pastikan status di database berubah menjadi 'selesai'
        $this->assertEquals('selesai', $order->fresh()->status);

        // 2. Pastikan respons adalah redirect ke URL WhatsApp yang benar
        $expectedWaUrl = "https://wa.me/6281234567890?text=";
        $this->assertTrue(str_starts_with($response->getTargetUrl(), $expectedWaUrl));
    }
}