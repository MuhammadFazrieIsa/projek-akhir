<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 'absen';

    protected $fillable = [
        'rfid_uid',
        'kedatangan',
        'kepulangan',
        'status',
    ];

    public $timestamps = false; // karena kita tidak pakai created_at dan updated_at
}

