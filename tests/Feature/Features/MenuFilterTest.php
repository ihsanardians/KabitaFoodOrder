<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MenuFilterTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function menu_can_be_filtered_by_category_and_sorted_by_price(): void
    {
        // Setup data
        Product::factory()->create(['name' => 'Steak', 'category' => 'Main Course', 'price' => 90000]);
        $dessert1 = Product::factory()->create(['name' => 'Pudding', 'category' => 'Dessert', 'price' => 15000]);
        $dessert2 = Product::factory()->create(['name' => 'Ice Cream', 'category' => 'Dessert', 'price' => 10000]);

        // Filter hanya kategori 'Dessert' dan urutkan harga termurah
        $response = $this->get(route('customer.menu.index', [
            'categories' => ['dessert'],
            'sort' => 'price_asc'
        ]));

        $response->assertStatus(200);
        $response->assertDontSee('Steak'); // Pastikan produk Main Course tidak tampil
        // Pastikan urutannya benar (Ice Cream dulu baru Pudding)
        $response->assertSeeInOrder(['Ice Cream', 'Pudding']);
    }
}