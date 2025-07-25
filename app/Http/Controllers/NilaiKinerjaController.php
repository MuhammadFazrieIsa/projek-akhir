<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\NilaiKehadiran;
use App\Models\NilaiKedisiplinan;
use App\Models\NilaiKinerja;
use App\Models\User;

class NilaikinerjaController extends Controller
{
    //======================== rekap kehadiran sebulan =========================

public function rekapKehadiran(Request $request)
{
    // $userId = auth()->user()->id;
    $users = user::all();
    $dataSemuaUser = [];
    $bulan = $request->input('bulan', now()->month);
    $tahun = $request->input('tahun', now()->year);
    
    foreach($users as $user){

    $userId=$user->rfid_uid;

    // Ambil bulan dan tahun dari request, atau default ke sekarang
    $bulan = $request->input('bulan', now()->month);
    $tahun = $request->input('tahun', now()->year);


    // Ambil data absensi sesuai bulan & tahun
    $absensi = Absen::where('rfid_uid', $userId)
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->get();

    // Hitung jumlah kehadiran
    $hadir = $absensi->where('status_kehadiran', 'Hadir')->count();
    $izin  = $absensi->where('status_kehadiran', 'Izin')->count();
    $alpa  = $absensi->where('status_kehadiran', 'Alpa')->count();

    $jumlahKehadiran = (1 * $hadir) + (0.5 * $izin) + (0 * $alpa);

    // Fuzzifikasi
    $nilaiKurangBaik = $this->fuzzyKurangBaik($jumlahKehadiran);
    $nilaiCukupBaik  = $this->fuzzyCukupBaik($jumlahKehadiran);
    $nilaiBaik       = $this->fuzzyBaik($jumlahKehadiran);

    // Simpan ke tabel nilai_kehadiran
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
    );$dataSemuaUser = $data;
    
    }
    $datas = NilaiKehadiran::with('user')
    ->where('bulan', $bulan)
    ->where('tahun', $tahun)
    ->get();

    

    return view('projek2.nilaiKehadiran', compact('datas','dataSemuaUser', 'bulan', 'tahun'))
        ->with('success', 'Rekap nilai kehadiran berhasil disimpan!');
}

private function fuzzyKurangBaik($x)
{
    if ($x <= 12) return 1;
    if ($x > 12 && $x < 18) return (18 - $x) / 6; // Menurun dari 1 ke 0
    return 0;
}

private function fuzzyCukupBaik($x)
{
    if ($x <= 12 || $x >= 24) return 0;
    if ($x > 12 && $x <= 18) return ($x - 12) / 6;     // Naik 0 ke 1
    if ($x > 18 && $x < 24) return (24 - $x) / 6;      // Turun 1 ke 0
    return 0;
}

private function fuzzyBaik($x)
{
    if ($x <= 18) return 0;
    if ($x > 18 && $x < 24) return ($x - 18) / 6;   // Naik 0 ke 1
    return 1; // Tetap 1 setelah 24
}


// ======================= Rekap kedisiplinan ===========================
public function rekapKedisiplinan(Request $request)
{
    // $userId = auth()->user()->id;

    $users = User::all();
    $dataSemuaUser = [];
    
    foreach($users as $user){

    $userId=$user->rfid_uid;

    $bulan = $request->input('bulan', now()->month);
    $tahun = $request->input('tahun', now()->year);

    // Ambil data absensi dari tabel absensi
    $absensi = Absen::where('rfid_uid', $userId)
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->get();

    $lebihAwal = $absensi->where('status_kedatangan', 'Lebih Awal')->count();
    $tepatWaktu = $absensi->where('status_kedatangan', 'Tepat Waktu')->count();
    $sedikitTerlambat = $absensi->where('status_kedatangan', 'Sedikit Terlambat')->count();
    $terlambat = $absensi->where('status_kedatangan', 'Terlambat')->count();

    $jumlahKeseluruhan = 
        (1 * $lebihAwal) +
        (0.8 * $tepatWaktu) +
        (0.5 * $sedikitTerlambat) +
        (0 * $terlambat);

    // Fuzzy membership
    $jumlahHari = $absensi->where('status_kehadiran', 'Hadir')->count();
 // jumlah data absensi = jumlah hari hadir

$nilaiKurangDisiplin = $this->fuzzyKurangDisiplin($jumlahKeseluruhan, $jumlahHari);
$nilaiCukupDisiplin  = $this->fuzzyCukupDisiplin($jumlahKeseluruhan, $jumlahHari);
$nilaiDisiplin       = $this->fuzzyDisiplin($jumlahKeseluruhan, $jumlahHari);


    // Simpan ke database
    $data = NilaiKedisiplinan::updateOrCreate(
        [
            'rfid_uid' => $userId,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ],
        [
            'lebih_awal' => $lebihAwal,
            'tepat_waktu' => $tepatWaktu,
            'agak_terlambat' => $sedikitTerlambat,
            'terlambat' => $terlambat,
            'jumlah_keseluruhan' => $jumlahKeseluruhan,
            'nilai_kurang_disiplin' => $nilaiKurangDisiplin,
            'nilai_cukup_disiplin' => $nilaiCukupDisiplin,
            'nilai_disiplin' => $nilaiDisiplin,
        ]
    );
   

    $dataSemuaUser = $data;
    }
    $datas = NilaiKedisiplinan::with('user')
    ->where('bulan', $bulan)
    ->where('tahun', $tahun)
    ->get(); 
    
    return view('projek2.nilaiKedisiplinan', compact('datas','data', 'bulan', 'tahun'))
        ->with('success', 'Rekap nilai kedisiplinan berhasil disimpan.');
}


private function fuzzyDisiplin($x, $jumlahHadir)
{
    $batasBawah = ($jumlahHadir + ($jumlahHadir / 2)) / 2; // sama dengan 0.75 * jumlahHadir

    if ($x >= $jumlahHadir) {
        return 1;
    } 
    
    if ($x >= $batasBawah && $x < $jumlahHadir) {
        return ($x - $batasBawah) / ($jumlahHadir - $batasBawah);
    } 
    
    if ($x < $batasBawah) {
        return 0;
    }
}


private function fuzzyCukupDisiplin($x, $jumlahHadir)
{
    $batasBawah = $jumlahHadir / 2;                  // 50% dari jumlah hadir
    $batasTengah = ($jumlahHadir + $batasBawah) / 2; // 75% dari jumlah hadir

    if ($x <= $batasBawah) {
        return 0;
    }

    if ($x > $batasBawah && $x <= $batasTengah) {
        return ($x - $batasBawah) / ($batasTengah - $batasBawah); // naik
    }

    if ($x > $batasTengah && $x < $jumlahHadir) {
        return ($jumlahHadir - $x) / ($jumlahHadir - $batasTengah); // turun
    }

    if ($x >= $jumlahHadir) {
        return 0;
    }
}


private function fuzzyKurangDisiplin($x, $jumlahHadir)
{
    $batasBawah = $jumlahHadir / 2;
    $batasTengah = ($jumlahHadir + $batasBawah) / 2; // 75%

    if ($x <= $batasBawah) {
        return 1;
    }

    if ($x > $batasBawah && $x < $batasTengah) {
        return ($batasTengah - $x) / ($batasTengah - $batasBawah); // turun
    }

    if ($x >= $batasTengah) {
        return 0;
    }
}


// ============= Panngil kedisiplinan ===============
public function panggilKehadiran(){}

// ============================== Rekapan nilai kinerja ============================
public function rekapKinerja(Request $request)
{
    // $userId = auth()->user()->id;
    $users = User::all();
    $dataSemuaUser = [];
    
    foreach($users as $user){

    $userId=$user->rfid_uid;

    $bulan = $request->input('bulan', now()->month);
    $tahun = $request->input('tahun', now()->year);

    // Cek apakah nilai_kinerja bulan ini sudah ada
    $existing = NilaiKinerja::where('rfid_uid', $userId)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->first();


    // ✅ Ambil nilai fuzzy kehadiran & kedisiplinan dari bulan & tahun yang sama
    $kehadiran = NilaiKehadiran::where('rfid_uid', $userId)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->first();

    $kedisiplinan = NilaiKedisiplinan::where('rfid_uid', $userId)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->first();

    if (!$kehadiran || !$kedisiplinan) {
        return back()->with('error', 'Data kehadiran atau kedisiplinan belum tersedia untuk bulan ini.');
    }

    // Daftar rule dan output
    $rules = [
        ['k' => 'nilai_baik',        'd' => 'nilai_disiplin',         'output' => 'baik'],
        ['k' => 'nilai_baik',        'd' => 'nilai_cukup_disiplin',   'output' => 'baik'],
        ['k' => 'nilai_baik',        'd' => 'nilai_kurang_disiplin',  'output' => 'cukup_baik'],
        ['k' => 'nilai_cukup_baik',  'd' => 'nilai_disiplin',         'output' => 'cukup_baik'],
        ['k' => 'nilai_cukup_baik',  'd' => 'nilai_cukup_disiplin',   'output' => 'cukup_baik'],
        ['k' => 'nilai_cukup_baik',  'd' => 'nilai_kurang_disiplin',  'output' => 'kurang_baik'],
        ['k' => 'nilai_kurang_baik', 'd' => 'nilai_disiplin',         'output' => 'cukup_baik'],
        ['k' => 'nilai_kurang_baik', 'd' => 'nilai_cukup_disiplin',   'output' => 'kurang_baik'],
        ['k' => 'nilai_kurang_baik', 'd' => 'nilai_kurang_disiplin',  'output' => 'kurang_baik'],
    ];

    // Fungsi output Z  berdasarkan potongan kurva(bobot dari masing-masing rule)
    $outputZ = [
        'baik' => function ($mu) {
            return $mu > 0 ? 75 + (15 * $mu) : 0; // Naik dari 75 ke 90
        },
        'cukup_baik' => function ($mu) {
            // Pisah jadi 2 sisi: tentukan dari sisi mana μ berasal
            // Tapi karena kamu gak punya info sisi, kita ambil rata-rata dua sisi
            $left = 60 + (15 * $mu);  // naik dari 60 ke 75
            $right = 90 - (15 * $mu); // turun dari 90 ke 75
            return $mu > 0 ? ($left + $right) / 2 : 0;
        },
        'kurang_baik' => function ($mu) {
            return $mu > 0 ? 60 + (15 * $mu) : 0; // Naik dari 60 ke 75
        }
    ];

        // ========== FUNGSI OUTPUT Z BERDASARKAN OUTPUT TETAP =============
        // $outputZ = [
        //     'baik' => fn($mu) => 90 - ($mu * (90 - 75)),
        //     'cukup_baik' => fn($mu) => 75 - ($mu * (75 - 60)),
        //     'kurang_baik' => fn($mu) => 60 - ($mu * 10), // 
        // ];
    

    $numerator = 0;
    $denominator = 0;
    $ruleResults = [];

    foreach ($rules as $index => $rule) {
        $muKehadiran = $kehadiran->{$rule['k']};
        $muDisiplin = $kedisiplinan->{$rule['d']};
        $mu = min($muKehadiran, $muDisiplin);
        $z = $outputZ[$rule['output']]($mu);

        $ruleResults['rule_' . ($index + 1)] = $mu;
        $numerator += $mu * $z;
        $denominator += $mu;
    }

    $zFinal = $denominator > 0 ? $numerator / $denominator : 0;

    // Tentukan status
    $status = null;
    if ($zFinal >= 90) {
        $status = 'Baik';
    } elseif ($zFinal > 60 && $zFinal < 90) {
        $status = 'Cukup Baik';
    } else {
        $status = 'Kurang Baik';
    }

    // Simpan jika belum ada

    $data = NilaiKinerja::updateOrCreate(
        ['rfid_uid' => $userId, 'bulan' => $bulan, 'tahun' => $tahun],
        array_merge($ruleResults, [
            'nilai_defuzzifikasi' => $zFinal,
            'status' => $status
        ])
    );
    $datas = NilaiKinerja::with('user')
    ->where('bulan', $bulan)
    ->where('tahun', $tahun)
    ->get();

    $dataSemuaUser = $data;
    }

    

    return view('projek2.hitungKinerja', [
        'ruleResults' => $ruleResults,
        'defuzzifikasi' => $zFinal,
        'status' => $status,
        'datas' => $datas,
        'data' => $data
    ])->with('success', 'Nilai kinerja berhasil direkap.');
}

private function fuzzyStatusKinerja($x)
{
    if ($x >= 90) return 'Baik';
    if ($x > 60 && $x < 90) return 'Cukup Baik';
    return 'Kurang Baik';
}

public function nilaiKinerja(){
    $datas = NilaiKinerja::with('user')->get();
    return view('projek2.kinerja', compact('datas'));
}

public function gabunganNilai(Request $request)
{
    $users = User::all();
    $dataSemuaUser = [];

    $bulan = $request->input('bulan', now()->month);
    $tahun = $request->input('tahun', now()->year);

    foreach ($users as $user) {
        $userId = $user->rfid_uid;

        // ============ HITUNG NILAI KEDISIPLINAN ===============
        $absensi = Absen::where('rfid_uid', $userId)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $lebihAwal = $absensi->where('status_kedatangan', 'Lebih Awal')->count();
        $tepatWaktu = $absensi->where('status_kedatangan', 'Tepat Waktu')->count();
        $sedikitTerlambat = $absensi->where('status_kedatangan', 'Sedikit Terlambat')->count();
        $terlambat = $absensi->where('status_kedatangan', 'Terlambat')->count();

        $jumlahKeseluruhan = 
            (1 * $lebihAwal) +
            (0.8 * $tepatWaktu) +
            (0.5 * $sedikitTerlambat) +
            (0 * $terlambat);

        $jumlahHari = $absensi->where('status_kehadiran', 'Hadir')->count();

        $nilaiKurangDisiplin = $this->fuzzyKurangDisiplin($jumlahKeseluruhan, $jumlahHari);
        $nilaiCukupDisiplin  = $this->fuzzyCukupDisiplin($jumlahKeseluruhan, $jumlahHari);
        $nilaiDisiplin       = $this->fuzzyDisiplin($jumlahKeseluruhan, $jumlahHari);

        $kedisiplinan = NilaiKedisiplinan::updateOrCreate(
            ['rfid_uid' => $userId, 'bulan' => $bulan, 'tahun' => $tahun],
            [
                'lebih_awal' => $lebihAwal,
                'tepat_waktu' => $tepatWaktu,
                'agak_terlambat' => $sedikitTerlambat,
                'terlambat' => $terlambat,
                'jumlah_keseluruhan' => $jumlahKeseluruhan,
                'nilai_kurang_disiplin' => $nilaiKurangDisiplin,
                'nilai_cukup_disiplin' => $nilaiCukupDisiplin,
                'nilai_disiplin' => $nilaiDisiplin,
            ]
        );

        // ============ HITUNG NILAI KINERJA ===============

        $kehadiran = NilaiKehadiran::where('rfid_uid', $userId)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        if (!$kehadiran || !$kedisiplinan) {
            continue; // lewati user ini jika data belum lengkap
        }

        $rules = [
            ['k' => 'nilai_baik',        'd' => 'nilai_disiplin',         'output' => 'baik'],
            ['k' => 'nilai_baik',        'd' => 'nilai_cukup_disiplin',   'output' => 'baik'],
            ['k' => 'nilai_baik',        'd' => 'nilai_kurang_disiplin',  'output' => 'cukup_baik'],
            ['k' => 'nilai_cukup_baik',  'd' => 'nilai_disiplin',         'output' => 'cukup_baik'],
            ['k' => 'nilai_cukup_baik',  'd' => 'nilai_cukup_disiplin',   'output' => 'cukup_baik'],
            ['k' => 'nilai_cukup_baik',  'd' => 'nilai_kurang_disiplin',  'output' => 'kurang_baik'],
            ['k' => 'nilai_kurang_baik', 'd' => 'nilai_disiplin',         'output' => 'cukup_baik'],
            ['k' => 'nilai_kurang_baik', 'd' => 'nilai_cukup_disiplin',   'output' => 'kurang_baik'],
            ['k' => 'nilai_kurang_baik', 'd' => 'nilai_kurang_disiplin',  'output' => 'kurang_baik'],
        ];

        $outputZ = [
            'baik' => fn($mu) => $mu > 0 ? 75 + (15 * $mu) : 0,
            'cukup_baik' => fn($mu) => $mu > 0 ? ((60 + (15 * $mu)) + (90 - (15 * $mu))) / 2 : 0,
            'kurang_baik' => fn($mu) => $mu > 0 ? 60 + (15 * $mu) : 0
        ];

        $numerator = 0;
        $denominator = 0;
        $ruleResults = [];

        foreach ($rules as $index => $rule) {
            $muKehadiran = $kehadiran->{$rule['k']};
            $muDisiplin = $kedisiplinan->{$rule['d']};
            $mu = min($muKehadiran, $muDisiplin);
            $z = $outputZ[$rule['output']]($mu);

            $ruleResults['rule_' . ($index + 1)] = $mu;
            $numerator += $mu * $z;
            $denominator += $mu;
        }

        $zFinal = $denominator > 0 ? $numerator / $denominator : 0;

        $status = match (true) {
            $zFinal >= 90 => 'Baik',
            $zFinal > 60  => 'Cukup Baik',
            default       => 'Kurang Baik'
        };

        $data = NilaiKinerja::updateOrCreate(
            ['rfid_uid' => $userId, 'bulan' => $bulan, 'tahun' => $tahun],
            array_merge($ruleResults, [
                'nilai_defuzzifikasi' => $zFinal,
                'status' => $status
            ])
        );

        $dataSemuaUser[] = $data;
    }

    $datas = NilaiKinerja::with('user')
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->get();

    return view('projek.kedisiplinan', compact('datas', 'bulan', 'tahun'))
        ->with('success', 'Nilai kedisiplinan dan kinerja berhasil direkap.');
}

public function nilaiAbsensi (){
    $datas = Absen::with('user')->get();
    return view('projek2.log', compact('datas'));
}

}

