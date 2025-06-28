<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // File: database/seeders/DatabaseSeeder.php
    public function run(): void
{
    $this->call([
        UserSeeder::class,
        PeriodeSeeder::class,
        AktifitasSeeder::class,
        KompetisiMandiriSeeder::class,
        KemendikbudSeeder::class,
        RekognisiSeeder::class,
        MbkmSeeder::class,
        SertifikatSeeder::class, // <-- Tambahkan ini terakhir
    ]);
}

}
