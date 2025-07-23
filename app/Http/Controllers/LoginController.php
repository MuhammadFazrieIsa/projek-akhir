<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

public function showLoginForm()
{
    return view('projek2.login'); // or wherever your login view is
}

public function login(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'password' => 'required|string',
    ]);

    $user = DB::table('users')->where('name', $request->name)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors(['name' => 'Invalid credentials.']);
    }

    // Store user info in session
    session(['user' => [
        'id' => $user->id,
        'name' => $user->name,
        'jabatan' => $user->jabatan,
    ]]);

    // Redirect based on jabatan
    switch ($user->jabatan) {
        case 'admin':
            return redirect()->route('dashboard');
        case 'manajer':
            return redirect()->route('dashboard2');
        case 'karyawan':
            return redirect()->route('dashboard3');
        default:
            return redirect()->route('login')->withErrors(['jabatan' => 'Jabatan Tidak Ada.']);
    }
}

public function logout()
{
    session()->forget('user');
    return redirect()->route('login')->with('status', 'Logged out berhasil!!.');
}

}
