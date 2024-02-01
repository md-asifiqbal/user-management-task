<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '123456',
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'User',
            'email' => 'user@example.com',
            'password' => '123456',
            'role' => 'user',
        ]);
    }
}
