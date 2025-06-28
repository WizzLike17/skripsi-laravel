<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Admin UNISA',
                'nim' => '1',
                'photo' => 'admin.jpg',
                'password' => Hash::make('123'),
                'role' => 'admin'
            ],
            [
                'nama' => 'Validator A',
                'nim' => '11',
                'photo' => 'validator.jpg',
                'password' => Hash::make('123'),
                'role' => 'validator'
            ],
            [
                'nama' => 'Validator B',
                'nim' => '22',
                'photo' => 'validator.jpg',
                'password' => Hash::make('123'),
                'role' => 'validator'
            ],
            [
                'nama' => 'Mahasiswa A',
                'nim' => '111',
                'photo' => 'mahasiswa.jpg',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa'
            ],
            [
                'nama' => 'Mahasiswa B',
                'nim' => '222',
                'photo' => 'mahasiswa.jpg',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa'
            ],
            [
                'nama' => 'Mahasiswa C',
                'nim' => '333',
                'photo' => 'mahasiswa.jpg',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa'
            ],
        ]);
    }
}
