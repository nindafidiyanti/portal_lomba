<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Branch Olahraga
        $cabangOlahraga = [
            'Karate',
            'Badminton',
            'Renang',
            'Futsal',
            'Sepak Bola',
            'Taekwondo',
            'Basket',
            'Voli',
            'Tenis Meja',
            'Pencak Silat',
        ];

        foreach ($cabangOlahraga as $cabang) {
            Setting::create([
                'type' => 'cabang_olahraga',
                'name' => $cabang,
            ]);
        }

        // Seed Kategori Peserta
        $kategoriPeserta = [
            'SD/SMP/SMA/Mahasiswa',
            'Umum',
            'Pelajar',
            'Profesional',
            'Junior',
            'Senior',
        ];

        foreach ($kategoriPeserta as $kategori) {
            Setting::create([
                'type' => 'kategori_peserta',
                'name' => $kategori,
            ]);
        }
    }
}
