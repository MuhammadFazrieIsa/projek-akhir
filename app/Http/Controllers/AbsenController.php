<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rfid_uid' => 'required|string',
        ]);

        $uid = strtoupper($request->rfid_uid);
        $today = Carbon::today();

        // Cari data absen hari ini dengan UID yang sama
        $absen = DB::table('absen')
            ->where('rfid_uid', $uid)
            ->whereDate('kedatangan', $today)
            ->first();

        if (!$absen) {
            // Belum ada data hari ini, catat kedatangan
            DB::table('absen')->insert([
                'rfid_uid' => $uid,
                'kedatangan' => now(),
            ]);
            return response()->json(['status' => 'success', 'message' => 'Kedatangan dicatat']);
        } elseif ($absen && !$absen->kepulangan) {
            // Sudah datang, tapi belum pulang → update kepulangan
            DB::table('absen')
                ->where('id', $absen->id)
                ->update(['kepulangan' => now()]);

            return response()->json(['status' => 'success', 'message' => 'Kepulangan dicatat']);
        } else {
            // Sudah absen datang & pulang
            return response()->json(['status' => 'info', 'message' => 'Sudah absen penuh hari ini']);
        }
    }
}
