<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        Pengguna::create([
            'nama_pengguna' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'kata_sandi' => Hash::make('password123'),
            'peran' => 'superadmin',
            'status' => 'aktif',
        ]);

        Pengguna::create([
            'nama_pengguna' => 'Admin',
            'email' => 'admin@gmail.com',
            'kata_sandi' => Hash::make('admin123'),
            'peran' => 'admin',
            'status' => 'aktif',
        ]);
    }
}
