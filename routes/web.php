<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RfidFormController;
use App\Http\Controllers\AbsenController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/absen', [AbsenController::class, 'store']);

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('projek2.dashboard');
})->middleware('role:admin')->name('dashboard.admin');

Route::get('/dashboard2', function () {
    return view('projek2.dashboard');
})->middleware('role:manajer')->name('dashboard.manajer');

Route::get('/dashboard3', function () {
    return view('projek2.dashboard');
})->middleware('role:karyawan')->name('dashboard.karyawan');

Route::get('/karyawan', [UserController::class, 'index'])
    ->middleware('role:admin')
    ->name('karyawan');

Route::delete('/karyawan/{id}', [UserController::class, 'destroy'])
    ->name('karyawan.destroy');

Route::get('/profile', function () {
    return view('projek2.profile');
})->middleware('role:admin')->name('profil');

use App\Http\Controllers\RfidController;

Route::get('/rfid/form', [RfidController::class, 'showForm'])->name('rfid.form');
Route::post('/rfid/store', [RfidController::class, 'storeRfidData'])->name('rfid.store');



