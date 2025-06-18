<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Staf Rutan
        User::create([
            'name' => 'Staf Rutan Batam',
            'email' => 'stafrutan@rutanbatam.com',
            'password' => Hash::make('Admin123!'),
            'role' => 'staf',
        ]);
        // Akun Contoh Pengunjung
        User::create([
            'name' => 'Contoh Pengunjung',
            'email' => 'pengunjung@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'pengunjung',
        ]);
    }
}
