<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\AbsenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rute-rute ini otomatis mendapat prefix "/api" dan middleware "api".
| Contoh akses: http://localhost:8000/api/produk
|
*/



// app/Http/Controllers/ArduinoController.php



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Tes endpoint
Route::get('/ping', function () {
    return response()->json(['message' => 'API aktif']);
});

Route::post('/rfid', [RfidController::class, 'store']);
Route::post('/absen', [AbsenController::class, 'store']);