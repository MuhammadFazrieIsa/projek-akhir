<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiKinerja extends Model
{
    protected $primaryKey = 'id_kinerja';

    protected $fillable = [
        'rfid_uid',
        'rule_1',
        'rule_2',
        'rule_3',
        'rule_4',
        'rule_5',
        'rule_6',
        'rule_7',
        'rule_8',
        'rule_9',
        'nilai_defuzzifikasi',
        'bulan',
        'tahun',
        // Tambahan jika ingin status
        'status',
    ];

    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class, 'rfid_uid', 'rfid_uid');
    }
    


}
