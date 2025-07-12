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
                'jabatan' => 'admin',
                'password' => Hash::make('123'),
                'rfid_uid' => 'A9F93E2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Abdan',
                'jabatan' => 'manajer',
                'password' => Hash::make('123'),
                'rfid_uid' => 'EE7AC85',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Isa',
                'jabatan' => 'karyawan',
                'password' => Hash::make('123'),
                'rfid_uid' => 'A156C85',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
