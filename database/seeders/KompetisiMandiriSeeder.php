<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KompetisiMandiriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kompetisi_mandiri')->insert([
            [
                'mahasiswa_id' => 4,
                'validator_id' => null,
                'status' => 'pending',
                'nama_kegiatan' => 'Hackathon Nasional',
                'link_penyelenggara' => 'http://hackathon.id',
                'dospem' => 'Dr. Rio',
                'capaian_prestasi' => 'Finalis',
                'sertifikat' => 'hackathon.jpg',
                'foto_penyerahan' => 'penyerahan2.jpg',
                'surat_tugas' => 'surat4.pdf',
                'jenis_kepesertaan' => 'Tim',
                'tanggal_pelaksanaan' => '2024-04-10',
                'tanggal_selesai' => '2024-04-12',
                'jumlah_anggota' => 3,
                'nidn_nidk' => '0987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
