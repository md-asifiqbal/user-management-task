<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '123456',
            'role' => 'admin',
        ]);
    }
}
