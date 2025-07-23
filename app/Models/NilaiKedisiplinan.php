<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiKedisiplinan extends Model
{
    protected $primaryKey = 'id_kedisiplinan';

    protected $fillable = [
        'rfid_uid',
        'lebih_awal',
        'tepat_waktu',
        'agak_terlambat',
        'terlambat',
        'jumlah_keseluruhan',
        'nilai_kurang_disiplin',
        'nilai_cukup_disiplin',
        'nilai_disiplin',
        'bulan',
        'tahun'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'rfid_uid','rfid_uid');
    }
}
