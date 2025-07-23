<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiKehadiran extends Model
{
    protected $primaryKey = 'id_kehadiran'; // Primary Key

    protected $fillable = [
        'rfid_uid',
        'hadir',
        'izin',
        'alpa',
        'jumlah_kehadiran',
        'nilai_kurang_baik',
        'nilai_cukup_baik',
        'nilai_baik',
        'bulan',
        'tahun'
    ];

    // Relasi ke User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class, 'rfid_uid','rfid_uid');
    }

    
}
