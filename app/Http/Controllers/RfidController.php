<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RfidController extends Controller
{
    public function showForm()
    {
        // Baca UID terakhir dari file
        $latestRfid = Storage::exists('latest_rfid.txt')
            ? Storage::get('latest_rfid.txt')
            : '';

        return view('projek.form', ['rfid_uid' => $latestRfid]);
    }

    public function storeRfidData(Request $request)
    {
        $validated = $request->validate([
            'rfid_uid' => 'required|string|max:255'
        ]);

        // Simpan ke file
        Storage::put('latest_rfid.txt', $validated['rfid_uid']);

        return response()->json([
            'status' => 'success',
            'rfid_uid' => $validated['rfid_uid']
        ]);
    }
}