<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\User;
use Carbon\Carbon;

class AbsenController extends Controller
{
public function store(Request $request)
{
    $uid = $request->input('uid');

    if (!$uid) {
        return response()->json(['error' => 'UID tidak ditemukan'], 400);
    }

    // ✅ Validasi apakah UID ada di tabel users
    $user = User::where('rfid_uid', $uid)->first();
    if (!$user) {
        return response()->json(['error' => 'UID tidak terdaftar pada user'], 403);
    }

    $now = \Carbon\Carbon::now();
    $today = $now->toDateString();

    // Cek status ONTIME / LATE
    $jamTepat = \Carbon\Carbon::createFromTimeString('08:00:00');
    $status = $now->lt($jamTepat) ? 'ONTIME' : 'LATE';

    // Cari entri belum pulang
    $absen = \App\Models\Absen::where('rfid_uid', $uid)
        ->whereDate('kedatangan', $today)
        ->whereNull('kepulangan')
        ->first();

    if ($absen) {
        $absen->kepulangan = $now;
        $absen->save();

        return response()->json(['status' => 'pulang', 'message' => 'Absen kepulangan tercatat']);
    } else {
        \App\Models\Absen::create([
            'rfid_uid' => $uid,
            'kedatangan' => $now,
            'status' => $status,
        ]);

        return response()->json([
            'status_kedatangan' => 'datang',
            'message' => 'Absen kedatangan tercatat',
            'ontime_status' => $status,
            'user' => $user->name
        ]);
    }
}

    
}
