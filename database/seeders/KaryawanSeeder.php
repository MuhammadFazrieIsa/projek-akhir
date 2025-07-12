<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $karyawans = [];

        for ($i = 1; $i <= 10; $i++) {
            $karyawans[] = [
                'foto' => null, // or you can use 'foto' => 'default.jpg'
                'nama' => "Karyawan $i",
                'nis' => 'NIS' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'jabatan' => ['Guru', 'Staf', 'Kepala Sekolah'][array_rand(['Guru', 'Staf', 'Kepala Sekolah'])],
                'jenis_kelamin' => ['Laki-Laki', 'Perempuan'][rand(0, 1)],
                'alamat' => "Alamat Karyawan $i",
                'uid' => strtoupper(Str::random(10)),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('karyawans')->insert($karyawans);
    }
}
