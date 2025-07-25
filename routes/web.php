<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RfidFormController;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    $user = session('user');

    if (!$user) {
        return redirect()->route('login');
    }

    switch ($user['jabatan']) {
        case 'Admin':
            return redirect()->route('dashboard');
        case 'Manajer':
            return redirect()->route('dashboard2');
        case 'Karyawan':
            return redirect()->route('dashboard3');
        default:
            return redirect()->route('login')->withErrors(['jabatan' => 'Jabatan Tidak Ada.']);
    }
});

// Login Routes
use App\Http\Controllers\LoginController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\PersenController;
Route::get('/dashboard', [PersenController::class, 'index'])
    ->middleware('role:Admin')
    ->name('dashboard');

Route::get('/dashboard2', [PersenController::class, 'index'])
    ->middleware('role:Manajer')
    ->name('dashboard2');

Route::get('/dashboard3', [PersenController::class, 'index'])
    ->middleware('role:Karyawan')
    ->name('dashboard3');

use App\Http\Controllers\UserController;
Route::get('/Karyawan', [UserController::class, 'index'])
    ->middleware('role:Admin')
    ->name('karyawan');

Route::get('/Karyawan2', [UserController::class, 'index'])
    ->middleware('role:Manajer')
    ->name('karyawan2');

Route::get('/Karyawan3', [UserController::class, 'index'])
    ->middleware('role:Karyawan')
    ->name('karyawan3');

Route::delete('/Karyawan/{id}', [UserController::class, 'destroy'])
    ->middleware('role:Admin')
    ->name('karyawan.destroy');

Route::get('/profile', function () {
    return view('projek2.profile');
})->middleware('role:Admin')->name('profil');

Route::get('/profile2', function () {
    return view('projek2.profile');
})->middleware('role:Manajer')->name('profil2');

Route::get('/profile3', function () {
    return view('projek2.profile');
})->middleware('role:Karyawan')->name('profil3');

use App\Http\Controllers\RfidController;
Route::get('/rfid', [RfidController::class, 'showForm'])->name('rfid.form');
Route::post('/rfid/store', [RfidController::class, 'storeRfidData'])->name('rfid.store');

use App\Http\Controllers\AbsenController;
Route::post('/absen', [AbsenController::class, 'store']);

use App\Http\Controllers\PresensiController;
Route::get('/presensi', [PresensiController::class, 'index'])
    ->middleware('role:Admin')
    ->name('rekap.presensi');
Route::get('/presensi2', [PresensiController::class, 'index'])
    ->middleware('role:Manajer')
    ->name('rekap.presensi2');
Route::get('/presensi3', [PresensiController::class, 'index'])
    ->middleware('role:Karyawan')
    ->name('rekap.presensi3');
Route::get('/presensi/pdf', [PresensiController::class, 'downloadPdf'])
    ->middleware('role:Admin')
    ->name('rekap.presensi.pdf');

use App\Http\Controllers\NilaiKinerjaController;
Route::get('/rekap', function () {
    return view('projek2.rekap');
})->middleware('role:Admin')->name('rekap.absensi');

Route::get('/rekap2', function () {
    return view('projek2.rekap');
})->middleware('role:Manajer')->name('rekap.absensi2');

Route::post('/kehadiran', [NilaiKinerjaController::class, 'rekapKehadiran'])
    ->middleware('role:Admin')
    ->name('kehadiran');
Route::post('/kehadiran2', [NilaiKinerjaController::class, 'rekapKehadiran'])
    ->middleware('role:Karyawan')
    ->name('kehadiran2');

Route::post('/kedisiplinan', [NilaiKinerjaController::class, 'rekapKedisiplinan'])
    ->middleware('role:Admin')
    ->name('kedisiplinan');
Route::post('/kedisiplinan2', [NilaiKinerjaController::class, 'rekapKedisiplinan'])
    ->middleware('role:Karyawan')
    ->name('kedisiplinan2');

Route::post('/nilaiKinerja', [NilaiKinerjaController::class, 'rekapKinerja'])
    ->middleware('role:Admin')
    ->name('rekap.kinerja');
Route::post('/nilaiKinerja2', [NilaiKinerjaController::class, 'rekapKinerja'])
    ->middleware('role:Karyawan')
    ->name('rekap.kinerja2');

Route::get('/nilaiKinerja', [NilaiKinerjaController::class, 'nilaiKinerja'])
    ->middleware('role:Admin')
    ->name('nilaiKinerja');
Route::get('/nilaiKinerja2', [NilaiKinerjaController::class, 'nilaiKinerja'])
    ->middleware('role:Admin')
    ->name('nilaiKinerja2');

Route::get('/log', [NilaiKinerjaController::class, 'nilaiAbsensi'])
    ->name('log');

