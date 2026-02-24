<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@simedik.com'], // Cek berdasarkan email
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('simedik123'),
                'role' => 'super_admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@simedik.com'],
            [
                'name' => 'Admin Kasir',
                'email_verified_at' => now(),
                'password' => Hash::make('simedik123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate([
            'email' => 'dokter@simedik.com',
        ], [
            'name' => 'Dokter Tirta',
            'email_verified_at' => now(),
            'password' => Hash::make('simedik123'),
            'role' => 'dokter',
        ]);
    }
}
