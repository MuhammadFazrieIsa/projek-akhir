<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto', 'nama', 'nis', 'jabatan', 'jenis_kelamin', 'alamat', 'uid'
    ];
}
