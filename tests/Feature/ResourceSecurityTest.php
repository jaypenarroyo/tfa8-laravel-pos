<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Database\Seeders\PosSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ResourceSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PosSeeder::class);
    }

    public function test_all_customer_and_user_resource_routes_use_auth_middleware(): void
    {
        foreach (['customers', 'users'] as $resource) {
            foreach (['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'] as $action) {
                $route = Route::getRoutes()->getByName("{$resource}.{$action}");

                $this->assertNotNull($route, "Missing {$resource}.{$action} resource route.");
                $this->assertContains('auth', $route->gatherMiddleware());
            }
        }
    }

    public function test_logged_out_visitors_are_redirected_from_protected_pages(): void
    {
        $customer = Customer::firstOrFail();
        $user = User::firstOrFail();

        foreach ([
            route('customers.index'),
            route('customers.create'),
            route('customers.show', $customer),
            route('customers.edit', $customer),
            route('users.index'),
            route('users.create'),
            route('users.show', $user),
            route('users.edit', $user),
        ] as $url) {
            $this->get($url)->assertRedirect(route('login'));
        }
    }

    public function test_logged_in_users_can_view_and_delete_resource_records(): void
    {
        $currentUser = User::where('username', 'admin')->firstOrFail();
        $customer = Customer::firstOrFail();
        $otherUser = User::where('username', 'cashier01')->firstOrFail();

        $this->actingAs($currentUser)->get(route('customers.show', $customer))->assertOk();
        $this->actingAs($currentUser)->get(route('users.show', $otherUser))->assertOk();

        $this->actingAs($currentUser)->delete(route('customers.destroy', $customer))->assertRedirect(route('customers.index'));
        $this->actingAs($currentUser)->delete(route('users.destroy', $otherUser))->assertRedirect(route('users.index'));

        $this->assertModelMissing($customer);
        $this->assertModelMissing($otherUser);
    }
}
