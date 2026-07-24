<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TempatLatihan;

class TempatLatihanSeeder extends Seeder
{
    public function run(): void
    {
        TempatLatihan::insert([
            [
                'nama_tempat' => 'Dojo Karate Garuda',
                'alamat' => 'Bekasi Timur',
                'cabor' => 'Karate',
                'link_maps' => 'https://maps.google.com',
                'deskripsi' => 'Tempat latihan karate untuk pemula hingga profesional.',
                'nama_pelatih' => 'Sensei Budi',
                'no_telepon' => '081234567890',
                'foto_tempat' => null,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Gor Badminton Jaya',
                'alamat' => 'Bekasi Barat',
                'cabor' => 'Badminton',
                'link_maps' => 'https://maps.google.com',
                'deskripsi' => 'Lapangan badminton indoor dengan fasilitas lengkap.',
                'nama_pelatih' => 'Andi Wijaya',
                'no_telepon' => '082233445566',
                'foto_tempat' => null,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Kolam Renang Tirta Indah',
                'alamat' => 'Cikarang',
                'cabor' => 'Renang',
                'link_maps' => 'https://maps.google.com',
                'deskripsi' => 'Tempat latihan renang dengan pelatih bersertifikat.',
                'nama_pelatih' => 'Siti Rahma',
                'no_telepon' => '083344556677',
                'foto_tempat' => null,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Arena Futsal Champion',
                'alamat' => 'Tambun',
                'cabor' => 'Futsal',
                'link_maps' => 'https://maps.google.com',
                'deskripsi' => 'Lapangan futsal standar nasional untuk latihan tim.',
                'nama_pelatih' => 'Coach Rudi',
                'no_telepon' => '085566778899',
                'foto_tempat' => null,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tempat' => 'Padepokan Silat Nusantara',
                'alamat' => 'Depok',
                'cabor' => 'Pencak Silat',
                'link_maps' => 'https://maps.google.com',
                'deskripsi' => 'Latihan pencak silat tradisional dan modern.',
                'nama_pelatih' => 'Pak Joko',
                'no_telepon' => '087788990011',
                'foto_tempat' => null,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}