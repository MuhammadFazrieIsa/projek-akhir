<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 'absen';

    protected $fillable = [
        'rfid_uid',
        'tanggal',
        'kedatangan',
        'kepulangan',
        'status_kedatangan',
        'status_kehadiran'
    ];

    public $timestamps = false; // karena kita tidak pakai created_at dan updated_at

    public function user()
{
    return $this->belongsTo(User::class, 'rfid_uid', 'rfid_uid');
}

}

