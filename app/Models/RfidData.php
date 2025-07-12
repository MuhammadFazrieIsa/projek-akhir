<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfidData extends Model
{
    use HasFactory; // Add HasFactory trait for using factories

    protected $table = 'rfid_data';
    protected $fillable = [
        'rfid_uid',
        'name'
    ];
}
