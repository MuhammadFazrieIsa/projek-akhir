<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\NilaiKehadiran;
use App\Models\NilaiKedisiplinan;
use App\Models\NilaiKinerja;
use App\Models\User;

class NilaiKinerjaController extends Controller
{
    public function rekapKehadiran(Request $request)
    {
        $users = User::all();
        $dataSemuaUser = [];
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        foreach ($users as $user) {
            $userId = $user->rfid_uid;

            $absensi = Absen::where('rfid_uid', $userId)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->get();

            $hadir = $absensi->where('status_kehadiran', 'Hadir')->count();
            $izin = $absensi->where('status_kehadiran', 'Izin')->count();
            $alpa = $absensi->where('status_kehadiran', 'Alpa')->count();

            $jumlahKehadiran = (1 * $hadir) + (0.5 * $izin) + (0 * $alpa);

            $nilaiKurangBaik = $this->fuzzyKurangBaik($jumlahKehadiran);
            $nilaiCukupBaik = $this->fuzzyCukupBaik($jumlahKehadiran);
            $nilaiBaik = $this->fuzzyBaik($jumlahKehadiran);

            $data = NilaiKehadiran::updateOrCreate(
                [
                    'rfid_uid' => $userId,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                ],
                [
                    'hadir' => $hadir,
                    'izin' => $izin,
                    'alpa' => $alpa,
                    'jumlah_kehadiran' => $jumlahKehadiran,
                    'nilai_kurang_baik' => $nilaiKurangBaik,
                    'nilai_cukup_baik' => $nilaiCukupBaik,
                    'nilai_baik' => $nilaiBaik,
                ]
            );

            $dataSemuaUser[] = $data;
        }

        $datas = NilaiKehadiran::with('user')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get();

        $pegawais = [];

        foreach ($users as $user) {
            $userId = $user->rfid_uid;

            $absensi = Absen::where('rfid_uid', $userId)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->orderBy('tanggal')
                ->get()
                ->keyBy(fn ($item) => (int) date('j', strtotime($item->tanggal)));

            $rekap = [];
            for ($i = 1; $i <= 31; $i++) {
                $rekap[] = isset($absensi[$i]) ? $absensi[$i]->status_kehadiran : '-';
            }

            $pegawais[] = [
                'nama' => $user->name,
                'rekap' => $rekap,
            ];
        }

        return view('projek2.rekap', compact('datas', 'bulan', 'tahun', 'pegawais'))
            ->with('success', 'Rekap nilai kehadiran berhasil disimpan!');
    }

    

    private function fuzzyKurangBaik($x)
    {
        if ($x <= 12) return 1;
        if ($x > 12 && $x < 18) return (18 - $x) / 6;
        return 0;
    }

    private function fuzzyCukupBaik($x)
    {
        if ($x <= 12 || $x >= 24) return 0;
        if ($x > 12 && $x <= 18) return ($x - 12) / 6;
        if ($x > 18 && $x < 24) return (24 - $x) / 6;
        return 0;
    }

    private function fuzzyBaik($x)
    {
        if ($x <= 18) return 0;
        if ($x > 18 && $x < 24) return ($x - 18) / 6;
        return 1;
    }
    
}
