<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Order;
use App\Models\OrderItem;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PdfInvoiceTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_generate_a_pdf_invoice_for_an_order(): void
    {
        $order = Order::factory()->has(OrderItem::factory()->count(2), 'items')->create();

        $response = $this->get(route('customer.order.invoice', $order->id));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }
}