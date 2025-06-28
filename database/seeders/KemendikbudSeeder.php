<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KemendikbudSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kemendikbud')->insert([
            [
                'mahasiswa_id' => 4,
                'validator_id' => 2,
                'status' => 'terima',
                'nama_kegiatan' => 'PKM AI',
                'surat' => 'surat1.pdf',
                'tanggal' => '2024-03-10',
                'ketua' => 'Mahasiswa A',
                'anggota' => 'Mahasiswa B, Mahasiswa C',
                'dospem' => 'Dr. Hasan',
                'keterlibatan_dospem' => 'Pembimbing utama',
                'prestasi' => 'Lolos pendanaan',
                'sertifikat' => 'sertifikat1.jpg',
                'lingkup_kegiatan' => 'Nasional',
                'sumber_biaya' => 'Kemendikbud',
                'biaya' => 1500000,
                'lokasi_kegiatan' => 'Universitas A',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
