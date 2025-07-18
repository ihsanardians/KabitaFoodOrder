<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Order;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function dashboard_only_shows_orders_being_processed(): void
    {
        $this->withoutVite();

        
        $admin = User::factory()->create();

        // Buat 2 jenis pesanan
        $processingOrder = Order::factory()->create(['status' => 'diproses']);
        $completedOrder = Order::factory()->create(['status' => 'selesai']);

        // Akses dashboard sebagai admin
        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        // Pastikan pesanan yang 'diproses' terlihat
        $response->assertSee($processingOrder->customer_name);
        // Pastikan pesanan yang 'selesai' TIDAK terlihat
        $response->assertDontSee($completedOrder->customer_name);
    }
}