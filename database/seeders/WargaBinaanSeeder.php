<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kamar; // <-- Import model Kamar
use App\Models\WargaBinaan; // <-- Import model WargaBinaan

class WargaBinaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data kamar yang sudah dibuat oleh KamarSeeder
        $kamarA1 = Kamar::where('nama_kamar', 'Kamar 101')->first();
        $kamarB1 = Kamar::where('nama_kamar', 'Kamar 201')->first();
        $kamarIsolasi = Kamar::where('nama_kamar', 'Sel Isolasi')->first();

        // Buat beberapa data warga binaan dummy
        if ($kamarA1) {
            WargaBinaan::create([
                'nama_lengkap' => 'Budi Santoso',
                'nomor_registrasi' => 'REG-001',
                'status' => 'Aktif',
                'kamar_id' => $kamarA1->id,
            ]);
            WargaBinaan::create([
                'nama_lengkap' => 'Eko Prasetyo',
                'nomor_registrasi' => 'REG-002',
                'status' => 'Aktif',
                'kamar_id' => $kamarA1->id,
            ]);
        }

        if ($kamarB1) {
            WargaBinaan::create([
                'nama_lengkap' => 'Agus Wijaya',
                'nomor_registrasi' => 'REG-003',
                'status' => 'Aktif',
                'kamar_id' => $kamarB1->id,
            ]);
        }

        if ($kamarIsolasi) {
             WargaBinaan::create([
                'nama_lengkap' => 'Joko Susilo',
                'nomor_registrasi' => 'REG-004',
                'status' => 'Tidak Aktif',
                'kamar_id' => $kamarIsolasi->id,
            ]);
        }
    }
}
