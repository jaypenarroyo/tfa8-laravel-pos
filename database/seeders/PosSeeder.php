<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PosSeeder extends Seeder
{
    public function run(): void
    {
        $createdAt = '2026-10-09 12:00:00';

        Customer::query()->insert([
            ['full_name' => 'Maria Santos', 'email' => 'maria.santos@example.com', 'phone' => '0917-123-4567', 'created_at' => $createdAt],
            ['full_name' => 'Juan Dela Cruz', 'email' => 'juan.delacruz@example.com', 'phone' => '0918-234-5678', 'created_at' => $createdAt],
            ['full_name' => 'Angela Reyes', 'email' => 'angela.reyes@example.com', 'phone' => '0919-345-6789', 'created_at' => $createdAt],
            ['full_name' => 'Carlo Mendoza', 'email' => 'carlo.mendoza@example.com', 'phone' => '0920-456-7890', 'created_at' => $createdAt],
            ['full_name' => 'Nicole Garcia', 'email' => 'nicole.garcia@example.com', 'phone' => '0921-567-8901', 'created_at' => $createdAt],
        ]);

        $password = Hash::make('password');

        User::query()->insert([
            ['username' => 'admin', 'full_name' => 'Andrea Lim', 'email' => 'admin@example.com', 'password' => $password, 'created_at' => $createdAt],
            ['username' => 'cashier01', 'full_name' => 'Paolo Cruz', 'email' => 'cashier01@example.com', 'password' => $password, 'created_at' => $createdAt],
            ['username' => 'cashier02', 'full_name' => 'Ella Ramos', 'email' => 'cashier02@example.com', 'password' => $password, 'created_at' => $createdAt],
            ['username' => 'manager01', 'full_name' => 'Miguel Torres', 'email' => 'manager01@example.com', 'password' => $password, 'created_at' => $createdAt],
            ['username' => 'inventory01', 'full_name' => 'Sofia Navarro', 'email' => 'inventory01@example.com', 'password' => $password, 'created_at' => $createdAt],
        ]);
    }
}
