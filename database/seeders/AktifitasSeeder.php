<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AktifitasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('aktifitas')->insert([
            [
                'mahasiswa_id' => 5,
                'validator_id' => null,
                'status' => 'pending',
                'nama_kegiatan' => 'Pelatihan Kewirausahaan',
                'peserta' => 'Mahasiswa B',
                'dospem' => 'Dr. Dedi',
                'keterlibatan_dospem' => 'Pengawas',
                'surat_tugas' => 'surat2.pdf',
                'sertifikat' => 'sertifikat2.jpg',
                'dokumentasi' => 'foto2.jpg',
                'deskripsi' => 'Pelatihan tentang UMKM digital',
                'link_penyelenggara' => 'http://umkm-event.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
