<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test; // Menggunakan sintaks modern
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Pastikan halaman utama dialihkan ke halaman menu.
     */
    #[Test]
    public function root_url_redirects_to_customer_menu(): void
    {
        $response = $this->get('/');

        // Memastikan halaman root dialihkan ke rute 'customer.menu.index'
        $response->assertRedirect(route('customer.menu.index'));
    }
}