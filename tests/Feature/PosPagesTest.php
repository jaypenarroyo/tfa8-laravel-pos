<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PosSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PosPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PosSeeder::class);
    }

    public function test_public_pages_are_available_and_resource_pages_require_login(): void
    {
        $this->get('/')->assertOk()->assertSee('POS Foundations');
        $this->get('/about')->assertOk()->assertSee('Securing POS resource management');
        $this->get('/customers')->assertRedirect(route('login'));
        $this->get('/users')->assertRedirect(route('login'));

        $user = User::where('username', 'admin')->firstOrFail();

        $this->actingAs($user)->get('/customers')->assertOk()->assertSee('Maria Santos');
        $this->actingAs($user)->get('/users')->assertOk()->assertSee('cashier01');
    }
}
