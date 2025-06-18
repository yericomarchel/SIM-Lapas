<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kamar; // <-- Penting: Import model Kamar

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika ada, agar tidak duplikat saat seeder dijalankan lagi
        // Kamar::truncate(); // Opsional

        Kamar::create([
            'nama_kamar' => 'Kamar 101',
            'blok' => 'A (Mawar)',
            'kapasitas' => 4,
        ]);

        Kamar::create([
            'nama_kamar' => 'Kamar 102',
            'blok' => 'A (Mawar)',
            'kapasitas' => 4,
        ]);

        Kamar::create([
            'nama_kamar' => 'Kamar 201',
            'blok' => 'B (Melati)',
            'kapasitas' => 2,
        ]);

        Kamar::create([
            'nama_kamar' => 'Kamar 202',
            'blok' => 'B (Melati)',
            'kapasitas' => 2,
        ]);

        Kamar::create([
            'nama_kamar' => 'Sel Isolasi',
            'blok' => 'C (Khusus)',
            'kapasitas' => 1,
        ]);
    }
}
