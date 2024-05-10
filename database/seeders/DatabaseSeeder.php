<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@codingaja.my.id',
            'username' => 'admin',
            'role' => 'admin',
            'no_telepon' => '081234567890',
            'password' => Hash::make('password')

        ]);
        User::create([
            'nama' => 'Manager',
            'email' => 'manager@codingaja.my.id',
            'username' => 'manager',
            'role' => 'manager',
            'no_telepon' => '081234567890',
            'password' => Hash::make('password')

        ]);
    }
}
