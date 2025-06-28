<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekognisiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rekognisi')->insert([
            [
                'mahasiswa_id' => 4,
                'validator_id' => null,
                'status' => 'pending',
                'nama_kegiatan' => 'Publikasi Ilmiah Nasional',
                'ketua' => 'Mahasiswa A',
                'anggota' => 'Mahasiswa B, Mahasiswa C',
                'surat_tugas' => 'surat4.pdf',
                'dospem' => 'Dr. Budi',
                'deskripsi_karya' => 'Jurnal tentang teknologi pembelajaran adaptif',
                'nama_lembaga_mitra' => 'LIPI',
                'no_surat_rekognisi' => 'REK-456/2024',
                'jenis_karya' => 'Artikel Ilmiah',
                'link_acara' => 'https://publikasi-lipi.id',
                'tahun' => '2024',
                'bukti_penyerahan' => 'bukti2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
