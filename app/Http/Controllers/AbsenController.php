<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\User;
use Carbon\Carbon;

class AbsenController extends Controller
{
    // ✅ Endpoint absensi via UID dari perangkat RFID (API)
    public function store(Request $request)
    {
        $uid = $request->input('uid');

        if (!$uid) {
            return response()->json(['error' => 'UID tidak ditemukan'], 400);
        }

        $user = User::where('rfid_uid', $uid)->first();

        if (!$user) {
            return response()->json(['error' => 'UID tidak terdaftar pada user'], 403);
        }

        $now = Carbon::now();
        $today = $now->toDateString();

        $absen = Absen::where('rfid_uid', $uid)
            ->whereDate('tanggal', $today)
            ->whereNull('kepulangan')
            ->first();

        if ($absen) {
            // Pulang
            $absen->kepulangan = $now->toTimeString();

            $durasiDetik = Carbon::parse($absen->kedatangan)->diffInSeconds($now);
            $jam = $durasiDetik / 3600;

            $statusHadir = match (true) {
                $jam >= 8     => 'Hadir',
                $jam >= 6.5   => 'Setengah Hari',
                $jam > 0      => 'Alpa',
                default       => 'Pending'
            };

            $absen->status_kehadiran = $statusHadir;
            $absen->save();

            return response()->json([
                'status' => 'pulang',
                'message' => 'Absen kepulangan tercatat',
                'status_kehadiran' => $statusHadir
            ]);
        } else {
            // Datang
            $jamDatang = $now->format('H:i');

            $waktu = strtotime($jamDatang);
            $early = strtotime('06:45');
            $onTime = strtotime('07:00');
            $grace = strtotime('07:15');
            $late = strtotime('08:00');

            $statusDatang = match (true) {
                $waktu <= $early => 'Sangat Awal',
                $waktu <= $onTime => 'Tepat Waktu',
                $waktu <= $grace => 'Sedikit Terlambat',
                $waktu <= $late => 'Terlambat',
                default => 'Sangat Terlambat'
            };

            Absen::create([
                'rfid_uid' => $uid,
                'tanggal' => $today,
                'kedatangan' => $now->toTimeString(),
                'status_kedatangan' => $statusDatang
            ]);

            return response()->json([
                'status' => 'datang',
                'message' => 'Absen kedatangan tercatat',
                'status_kedatangan' => $statusDatang,
                'user' => $user->name
            ]);
        }
    }

    // ✅ Absen datang manual via Web Form
    public function datang(Request $request)
    {
        $request->validate([
            'rfid_uid' => 'required',
            'jam_datang' => 'required',
        ]);

        $jamDatang = $request->jam_datang;
        $rfid = $request->rfid_uid;
        $today = Carbon::now()->toDateString();

        $waktu = strtotime($jamDatang);
        $early = strtotime('06:45');
        $onTime = strtotime('07:00');
        $grace = strtotime('07:15');
        $late = strtotime('08:00');

        $statusDatang = match (true) {
            $waktu <= $early => 'Sangat Awal',
            $waktu <= $onTime => 'Tepat Waktu',
            $waktu <= $grace => 'Sedikit Terlambat',
            $waktu <= $late => 'Terlambat',
            default => 'Sangat Terlambat'
        };

        $absen = Absen::updateOrCreate(
            [
                'rfid_uid' => $rfid,
                'tanggal' => $today,
            ],
            [
                'kedatangan' => $jamDatang,
                'status_kedatangan' => $statusDatang,
                'kepulangan' => null,
                'status_kehadiran' => null,
            ]
        );

        return view('absensi.absensiDatang', ['absensiHariIni' => $absen])
            ->with('success', 'Jam kedatangan berhasil disimpan!');
    }

    // ✅ Absen pulang via Web Form
    public function pulang(Request $request)
    {
        $request->validate([
            'rfid_uid' => 'required',
            'jam_pulang' => 'required',
        ]);

        $jamPulang = $request->jam_pulang;
        $rfid = $request->rfid_uid;
        $today = Carbon::now()->toDateString();

        $absen = Absen::where('rfid_uid', $rfid)
            ->whereDate('tanggal', $today)
            ->first();

        if (!$absen) {
            return back()->with('error', 'Data absensi kedatangan belum tercatat.');
        }

        $jamDatang = strtotime($absen->kedatangan);
        $jamPulangTime = strtotime($jamPulang);
        $durasiKerja = ($jamPulangTime - $jamDatang) / 3600;

        $statusHadir = match (true) {
            $durasiKerja >= 8     => 'Hadir',
            $durasiKerja >= 6.5   => 'Setengah Hari',
            $durasiKerja > 0      => 'Alpa',
            default               => 'Kurang Jam'
        };

        $absen->update([
            'kepulangan' => $jamPulang,
            'status_kehadiran' => $statusHadir,
        ]);

        return view('absensi.absensiPulang', ['absensiHariIni' => $absen->fresh()]);
    }
}
