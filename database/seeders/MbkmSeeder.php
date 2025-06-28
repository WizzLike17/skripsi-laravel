<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MbkmSeeder extends Seeder
{
    public function run(): void
    {
        $mbkmId = DB::table('mbkm')->insertGetId([
            'mahasiswa_id' => 5,
            'validator_id' => null,
            'status' => 'pending',
            'nama_kegiatan' => 'Studi Independen UI/UX',
            'ketua' => 'Mahasiswa B',
            'anggota' => 'Mahasiswa A, Mahasiswa C',
            'dospem' => 'Dr. Ahmad',
            'keterlibatan_dospem' => 'Monitoring',
            'sumber_biaya' => 'Beasiswa',
            'sertifikat' => 'sertifikat2.pdf',
            'nama_mitra' => 'Dicoding',
            'lokasi_mitra' => 'Bandung',
            'surat_kerja_sama' => 'surat2.pdf',
            'tanggal_pelaksanaan' => '2024-02-01',
            'tanggal_selesai' => '2024-07-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
