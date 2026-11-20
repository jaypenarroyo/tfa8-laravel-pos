<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Database\Seeders\PosSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DatabaseStructureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PosSeeder::class);
    }

    public function test_the_pos_seeder_populates_both_models(): void
    {
        $this->assertSame(5, Customer::count());
        $this->assertSame(5, User::count());
        $this->assertSame('Maria Santos', Customer::first()->full_name);
        $this->assertSame('admin', User::first()->username);
        $this->assertTrue(Hash::check('password', User::first()->password));
    }

    public function test_usernames_are_unique(): void
    {
        $this->expectException(QueryException::class);

        User::create([
            'username' => 'admin',
            'full_name' => 'Duplicate Admin',
            'email' => 'duplicate@example.com',
            'password' => 'password',
        ]);
    }
}
