<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Yusuf',
                'jabatan' => 'Admin',
                'password' => Hash::make('123'),
                'rfid_uid' => 'A9F93E2',
                'jenis_kelamin' => 'Laki-Laki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Abdan',
                'jabatan' => 'Manajer',
                'password' => Hash::make('123'),
                'rfid_uid' => 'EE7AC85',
                'jenis_kelamin' => 'Laki-Laki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Isa',
                'jabatan' => 'Karyawan',
                'password' => Hash::make('123'),
                'rfid_uid' => 'A156C85',
                'jenis_kelamin' => 'Laki-Laki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jia',
                'jabatan' => 'Karyawan',
                'password' => Hash::make('123'),
                'rfid_uid' => '3AA4363',
                'jenis_kelamin' => 'Perempuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
