<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@simedik.com',
            'email_verified_at' => now(),
            'password' => Hash::make('simedik123'),
            'role' => 'super_admin',
        ]);

        User::create([
            'name' => 'Admin Kasir',
            'email' => 'admin@simedik.com',
            'email_verified_at' => now(),
            'password' => Hash::make('simedik123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Dokter Tirta',
            'email' => 'dokter@simedik.com',
            'email_verified_at' => now(),
            'password' => Hash::make('simedik123'),
            'role' => 'dokter', 
        ]);
    }
}