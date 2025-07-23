<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dataAbsen extends Seeder
{
    /**
     * Run the database seeds.
     */
    
     public function run()
     {
         $rfidList = [
             'A9F93E2', // User 1 → Baik (18+ hadir)
             'EE7AC85', // User 2 → Cukup baik (15-17 hadir)
             'A156C85', // User 3 → Kurang baik (12-14 hadir)
             'A156C87', // User 4 → Campuran
         ];
 
         foreach ($rfidList as $index => $rfid) {
             $jumlahHadir = match($index) {
                 0 => 19, // Baik
                 1 => 16, // Cukup Baik
                 2 => 13, // Kurang Baik
                 default => rand(12, 17)
             };
 
             $jumlahIzin = rand(3, 6);
             $jumlahAlpa = 24 - $jumlahHadir - $jumlahIzin;
 
             $statusList = array_merge(
                 array_fill(0, $jumlahHadir, 'Hadir'),
                 array_fill(0, $jumlahIzin, 'Izin'),
                 array_fill(0, $jumlahAlpa, 'Alpha')
             );
 
             shuffle($statusList);
 
             for ($i = 0; $i < 24; $i++) {
                 $tanggal = Carbon::parse('2025-06-01')->addDays($i);
                 $status = $statusList[$i];
 
                 $kedatangan = null;
                 $kepulangan = null;
                 $statusKedatangan = null;
 
                 if ($status == 'Hadir') {
                     // Kedatangan antara 06:30 - 08:00
                     $jamDatang = Carbon::createFromTime(rand(6, 8), rand(0, 59));
                     $jamPulang = (clone $jamDatang)->addHours(8);
 
                     $kedatangan = $jamDatang->format('H:i:s');
                     $kepulangan = $jamPulang->format('H:i:s');
 
                     // Logika status_kedatangan
                     $time = strtotime($jamDatang->format('H:i'));
                     $lebihAwal = strtotime('06:45');
                     $tepatWaktu = strtotime('07:00');
                     $sedikitTerlambat = strtotime('07:15');
 
                     if ($time <= $lebihAwal) {
                         $statusKedatangan = 'Lebih Awal';
                     } elseif ($time <= $tepatWaktu) {
                         $statusKedatangan = 'Tepat Waktu';
                     } elseif ($time <= $sedikitTerlambat) {
                         $statusKedatangan = 'Sedikit Terlambat';
                     } else {
                         $statusKedatangan = 'Terlambat';
                     }
                 }
 
                 DB::table('absen')->insert([
                     'rfid_uid' => $rfid,
                     'tanggal' => $tanggal->format('Y-m-d'),
                     'kedatangan' => $kedatangan,
                     'kepulangan' => $kepulangan,
                     'status_kedatangan' => $statusKedatangan,
                     'status_kehadiran' => $status,

                 ]);
             }
         }
     }
}
