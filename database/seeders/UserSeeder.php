<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun contoh untuk user biasa
        User::create([
            'name' => 'Andi Sports',
            'email' => 'andi@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Budi Pratama',
            'email' => 'budi@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Citra Wijaya',
            'email' => 'citra@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Catatan: Admin login menggunakan username 'admin' dan password '123'
        // bukan email biasa, jadi tidak perlu dibuat di tabel users
    }
}
