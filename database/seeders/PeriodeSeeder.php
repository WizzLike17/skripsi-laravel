<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('periodes')->insert([
            [
                'tanggal_mulai' => '2023-06-12',
                'tanggal_selesai' => '2024-01-01',
                'status' => true,
                'jenis_periode' => 'ganjil',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
