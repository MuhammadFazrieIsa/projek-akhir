<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Carbon\Carbon;

class AbsenController extends Controller
{
public function store(Request $request)
{
    $uid = $request->input('uid');

    if (!$uid) {
        return response()->json(['error' => 'UID tidak ditemukan'], 400);
    }

    $now = Carbon::now();
    $today = $now->toDateString();

    // Tentukan status absensi
    $jamTepat = Carbon::createFromTimeString('08:00:00');
    $status = $now->lt($jamTepat) ? 'ONTIME' : 'LATE';

    // Cek apakah ada kedatangan hari ini yang belum punya kepulangan
    $absen = Absen::where('rfid_uid', $uid)
        ->whereDate('kedatangan', $today)
        ->whereNull('kepulangan')
        ->first();

    if ($absen) {
        $absen->kepulangan = $now;
        $absen->save();

        return response()->json(['status' => 'pulang', 'message' => 'Absen kepulangan tercatat']);
    } else {
        Absen::create([
            'rfid_uid' => $uid,
            'kedatangan' => $now,
            'status' => $status
        ]);

        return response()->json([
            'status' => 'datang',
            'message' => 'Absen kedatangan tercatat',
            'ontime_status' => $status
        ]);
    }
}

    
}
