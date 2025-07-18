<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
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
    public function admin_can_create_a_new_cashier(): void
    {
        $newPassword = 'a-Very-Strong-Password-123!!#'; // <-- Gunakan password yang kuat

        $response = $this->post(route('admin.users.store'), [
            'name' => 'Budi Kasir',
            'email' => 'budi@kasir.com',
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'budi@kasir.com'
        ]);
    }

    #[Test]
    public function cashier_creation_fails_with_invalid_password(): void
    {
        $response = $this->post(route('admin.users.store'), [
            'name' => 'Cici Kasir',
            'email' => 'cici@kasir.com',
            'password' => '12345', // Password terlalu pendek
            'password_confirmation' => '12345',
        ]);

        $response->assertSessionHasErrors('password');
    }
}