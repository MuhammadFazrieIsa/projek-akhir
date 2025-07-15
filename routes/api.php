<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rute-rute ini otomatis mendapat prefix "/api" dan middleware "api".
| Contoh akses: http://localhost:8000/api/produk
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Tes endpoint
Route::get('/ping', function () {
    return response()->json(['message' => 'API aktif']);
});

use App\Http\Controllers\RfidController;
Route::post('/rfid/uid', [RfidController::class, 'storeRfidUid']);
Route::post('/rfid', [RfidController::class, 'storeRfidData']);

use App\Http\Controllers\AbsenController;
Route::post('/absen', [AbsenController::class, 'store']);