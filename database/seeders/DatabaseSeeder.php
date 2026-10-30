<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Safira', // <-- Ubah di sini jadi Safira
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Buat Akun Staff
        User::updateOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'Staff Toko',
                'password' => Hash::make('password123'),
                'role' => 'staff',
            ]
        );
    }
}