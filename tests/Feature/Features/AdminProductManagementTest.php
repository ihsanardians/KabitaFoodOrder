<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminProductManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_create_a_product(): void
    {
        Storage::fake('public');
        $image = UploadedFile::fake()->image('pizza.jpg');
        
        $this->post(route('admin.products.store'), [
            'name' => 'Pizza Margherita',
            'category' => 'Main Course',
            'price' => 55000,
            'description' => 'Pizza klasik.',
            'image' => $image,
        ])->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', ['name' => 'Pizza Margherita']);
        Storage::disk('public')->assertExists('products/' . $image->hashName());
    }

    #[Test]
    public function admin_can_update_a_product(): void
    {
        $product = Product::factory()->create();
        $this->put(route('admin.products.update', $product), [
            'name' => 'Nama Baru',
            'price' => 99000,
            'category' => $product->category,
            'description' => 'Deskripsi baru.'
        ])->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Nama Baru']);
    }
}