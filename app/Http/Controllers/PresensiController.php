<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absen;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PresensiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        $pegawai = $request->input('pegawai', 'semua');

        // Ambil semua jabatan unik
        $jabatanList = User::select('jabatan')->distinct()->pluck('jabatan');

        // Ambil semua user (filter berdasarkan jabatan jika tidak 'semua')
        $query = User::query();
        if ($pegawai != 'semua') {
            $query->where('jabatan', $pegawai);
        }

        $users = $query->get();

        $presensiData = [];

        foreach ($users as $user) {
            $rekap = [];

            for ($i = 1; $i <= 31; $i++) {
                $tanggal = Carbon::createFromDate($tahun, $bulan, $i)->format('Y-m-d');

                $absen = Absen::where('rfid_uid', $user->rfid_uid)
                    ->where('tanggal', $tanggal)
                    ->first();

                if (!$absen) {
                    $rekap[] = 'TAM'; // Tidak Absen Masuk
                } else {
                    if (!$absen->kedatangan) {
                        $rekap[] = 'TAM';
                    } elseif ($absen->status_kedatangan === 'Sangat Terlambat') {
                        $rekap[] = 'TL';
                    } else {
                        $rekap[] = 'V';
                    }

                    if (!$absen->kepulangan) {
                        $rekap[count($rekap) - 1] = 'TAP'; // Tidak Absen Pulang
                    } elseif ($absen->status_kehadiran === 'Pulang Cepat') {
                        $rekap[count($rekap) - 1] = 'PSW'; // Pulang Sebelum Waktunya
                    }
                }
            }

            $presensiData[] = [
                'nama' => $user->name,
                'jabatan' => $user->jabatan,
                'rekap' => $rekap,
            ];
        }

        return view('projek2.presensi', compact('jabatanList', 'presensiData', 'bulan', 'tahun'), [
    'bulan' => request('bulan', date('m')),
    'tahun' => request('tahun', date('Y')),
]);
    }
   public function downloadPdf(Request $request)
{
    $bulan = $request->input('bulan', date('m'));
    $tahun = $request->input('tahun', date('Y'));
    $pegawai = $request->input('pegawai', 'semua');

    // Jumlah hari sesuai bulan dan tahun
    $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

    // Ambil semua user berdasarkan filter jabatan
    $query = User::query();
    if ($pegawai != 'semua') {
        $query->where('jabatan', $pegawai);
    }
    $users = $query->get();

    $presensiData = [];

    foreach ($users as $user) {
        $rekap = [];

        for ($i = 1; $i <= $jumlahHari; $i++) {
            $tanggal = Carbon::createFromDate($tahun, $bulan, $i)->format('Y-m-d');

            $absen = Absen::where('rfid_uid', $user->rfid_uid)
                ->where('tanggal', $tanggal)
                ->first();

            if (!$absen) {
                $rekap[] = 'TAM';
            } else {
                if (!$absen->kedatangan) {
                    $rekap[] = 'TAM';
                } elseif ($absen->status_kedatangan === 'Sangat Terlambat') {
                    $rekap[] = 'TL';
                } else {
                    $rekap[] = 'V';
                }

                if (!$absen->kepulangan) {
                    $rekap[count($rekap) - 1] = 'TAP';
                } elseif ($absen->status_kehadiran === 'Pulang Cepat') {
                    $rekap[count($rekap) - 1] = 'PSW';
                }
            }
        }

        $presensiData[] = [
            'nama' => $user->name,
            'jabatan' => $user->jabatan,
            'rekap' => $rekap,
        ];
    }

    // Load view dan generate PDF landscape
    $pdf = Pdf::loadView('projek2.presensi_pdf', [
        'presensiData' => $presensiData,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'jumlahHari' => $jumlahHari,
        'pegawai' => $pegawai
    ])->setPaper('a4', 'landscape');

    return $pdf->download("Rekap_Presensi_{$bulan}_{$tahun}.pdf");
}


    
}
