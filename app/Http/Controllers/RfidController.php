<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RfidController extends Controller
{
    // Menampilkan form dan isi UID terakhir
    public function showForm()
    {
        $latestRfid = Storage::exists('latest_rfid.txt')
            ? Storage::get('latest_rfid.txt')
            : '';

        return view('projek2.form', ['rfid_uid' => $latestRfid]);
    }

    // Untuk menyimpan dari form Laravel (ke database users)
    public function storeRfidData(Request $request)
    {
        $validated = $request->validate([
            'rfid_uid' => 'required|string|max:255|unique:users,rfid_uid',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'jabatan' => 'required|string|max:100',
        ]);

        // Simpan ke file
        Storage::put('latest_rfid.txt', $validated['rfid_uid']);

        // Simpan user ke database
        $user = new User();
        $user->name = $validated['name'];
        $user->rfid_uid = $validated['rfid_uid'];
        $user->password = Hash::make($validated['password']);
        $user->jabatan = $validated['jabatan'];
        $user->save();

        return redirect()->back()->with('status', 'Data pengguna berhasil disimpan!');
    }

    // Untuk request dari Arduino (hanya simpan UID ke file)
    public function storeRfidUid(Request $request)
    {
        $validated = $request->validate([
            'rfid_uid' => 'required|string|max:255',
        ]);

        Storage::put('latest_rfid.txt', $validated['rfid_uid']);

        return response()->json([
            'status' => 'success',
            'rfid_uid' => $validated['rfid_uid']
        ]);
    }
}
