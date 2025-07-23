<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RfidFormController;


// Login Routes
use App\Http\Controllers\LoginController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\PersenController;
Route::get('/dashboard', [PersenController::class, 'index'])
    ->middleware('role:admin')
    ->name('dashboard');

Route::get('/dashboard2', [PersenController::class, 'index'])
    ->middleware('role:manajer')
    ->name('dashboard2');

Route::get('/dashboard3', [PersenController::class, 'index'])
    ->middleware('role:karyawan')
    ->name('dashboard3');

use App\Http\Controllers\UserController;
Route::get('/karyawan', [UserController::class, 'index'])
    ->middleware('role:admin')
    ->name('karyawan');

Route::get('/karyawan2', [UserController::class, 'index'])
    ->middleware('role:manajer')
    ->name('karyawan2');

Route::get('/karyawan3', [UserController::class, 'index'])
    ->middleware('role:karyawan')
    ->name('karyawan3');

Route::delete('/karyawan/{id}', [UserController::class, 'destroy'])
    ->middleware('role:admin')
    ->name('karyawan.destroy');

Route::get('/profile', function () {
    return view('projek2.profile');
})->middleware('role:admin')->name('profil');

Route::get('/profile2', function () {
    return view('projek2.profile');
})->middleware('role:manajer')->name('profil2');

Route::get('/profile3', function () {
    return view('projek2.profile');
})->middleware('role:karyawan')->name('profil3');

use App\Http\Controllers\RfidController;
Route::get('/rfid', [RfidController::class, 'showForm'])->name('rfid.form');
Route::post('/rfid/store', [RfidController::class, 'storeRfidData'])->name('rfid.store');

use App\Http\Controllers\AbsenController;
Route::post('/absen', [AbsenController::class, 'store']);

use App\Http\Controllers\PresensiController;
Route::get('/presensi', [PresensiController::class, 'index'])
    ->middleware('role:admin')
    ->name('rekap.presensi');
Route::get('/presensi2', [PresensiController::class, 'index'])
    ->middleware('role:manajer')
    ->name('rekap.presensi2');
Route::get('/presensi3', [PresensiController::class, 'index'])
    ->middleware('role:karyawan')
    ->name('rekap.presensi3');
Route::get('/presensi/pdf', [PresensiController::class, 'downloadPdf'])
    ->middleware('role:admin')
    ->name('rekap.presensi.pdf');

use App\Http\Controllers\NilaiKinerjaController;
Route::get('/rekap', function () {
    return view('projek2.rekap');
})->middleware('role:admin')->name('rekap.absensi');

Route::get('/rekap2', function () {
    return view('projek2.rekap');
})->middleware('role:manajer')->name('rekap.absensi2');

Route::post('/kehadiran', [NilaiKinerjaController::class, 'rekapKehadiran'])
    ->middleware('role:admin')
    ->name('kehadiran');
Route::post('/kehadiran2', [NilaiKinerjaController::class, 'rekapKehadiran'])
    ->middleware('role:karyawan')
    ->name('kehadiran2');

Route::post('/kedisiplinan', [NilaiKinerjaController::class, 'rekapKedisiplinan'])
    ->middleware('role:admin')
    ->name('kedisiplinan');
Route::post('/kedisiplinan2', [NilaiKinerjaController::class, 'rekapKedisiplinan'])
    ->middleware('role:karyawan')
    ->name('kedisiplinan2');

Route::post('/nilaiKinerja', [NilaiKinerjaController::class, 'rekapKinerja'])
    ->middleware('role:admin')
    ->name('rekap.kinerja');
Route::post('/nilaiKinerja2', [NilaiKinerjaController::class, 'rekapKinerja'])
    ->middleware('role:karyawan')
    ->name('rekap.kinerja2');

