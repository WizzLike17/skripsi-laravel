<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SertifikatSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sertifikat')->insert([
            [
                'periode_id' => 1,
                'id_aktifitas' => 1,
                'id_kompetisi' => null,
                'id_kmdb' => null,
                'id_mbkm' => null,
                'id_rekognisi' => null,
                'mahasiswa_id' => 5,
                'validator_id' => null,
                'nama_kegiatan' => 'Pelatihan Kewirausahaan',
                'nilai' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'periode_id' => 1,
                'id_aktifitas' => null,
                'id_kompetisi' => 1,
                'id_kmdb' => null,
                'id_mbkm' => null,
                'id_rekognisi' => null,
                'mahasiswa_id' => 4,
                'validator_id' => null,
                'nama_kegiatan' => 'Hackathon Nasional',
                'nilai' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'periode_id' => 1,
                'id_aktifitas' => null,
                'id_kompetisi' => null,
                'id_kmdb' => 1,
                'id_mbkm' => null,
                'id_rekognisi' => null,
                'mahasiswa_id' => 4,
                'validator_id' => 2,
                'nama_kegiatan' => 'PKM AI',
                'nilai' => 85.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'periode_id' => 1,
                'id_aktifitas' => null,
                'id_kompetisi' => null,
                'id_kmdb' => null,
                'id_mbkm' => 1,
                'id_rekognisi' => null,
                'mahasiswa_id' => 5,
                'validator_id' => null,
                'nama_kegiatan' => 'Studi Independen UI/UX',
                'nilai' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'periode_id' => 1,
                'id_aktifitas' => null,
                'id_kompetisi' => null,
                'id_kmdb' => null,
                'id_mbkm' => null,
                'id_rekognisi' => 1,
                'mahasiswa_id' => 4,
                'validator_id' => null,
                'nama_kegiatan' => 'Publikasi Ilmiah Nasional',
                'nilai' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
