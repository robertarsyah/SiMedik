<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'name' => 'BUDI SANTOSO',
                'nik' => '3273011203900001',
                'birth_date' => '1990-03-12',
                'gender' => 'L',
                'phone' => '081234567890',
                'address' => 'Jl. Buah Batu No. 12, Bandung',
            ],
            [
                'name' => 'SITI AMINAH',
                'nik' => '3273014506950002',
                'birth_date' => '1995-06-15',
                'gender' => 'P',
                'phone' => '085712345678',
                'address' => 'Perum Griya Asri Blok C, Cimahi',
            ],
            [
                'name' => 'ANDI WIJAYA',
                'nik' => '3273022108880003',
                'birth_date' => '1988-08-21',
                'gender' => 'L',
                'phone' => '082198765432',
                'address' => 'Jl. Kopo Sayati No. 45, Bandung',
            ],
            [
                'name' => 'LANI LESTARI',
                'nik' => '3273036010920004',
                'birth_date' => '1992-10-10',
                'gender' => 'P',
                'phone' => '081322334455',
                'address' => 'Soreang Indah Blok A1, Kab. Bandung',
            ],
            [
                'name' => 'DEWA GEDE',
                'nik' => '3273041505850005',
                'birth_date' => '1985-05-15',
                'gender' => 'L',
                'phone' => '087855667788',
                'address' => 'Apartemen Gateway Cicadas, Bandung',
            ],
        ];

        foreach ($patients as $patient) {
            \App\Models\Patient::updateOrCreate(['nik' => $patient['nik']], $patient);
        }
    }
}
