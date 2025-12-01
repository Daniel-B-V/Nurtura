<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@nurtura.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+1234567890',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create Regular Staff Users
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@nurtura.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '+1234567891',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'john@nurtura.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '+1234567892',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}
