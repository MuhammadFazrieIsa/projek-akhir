<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $karyawans = Karyawan::when($search, function ($query, $search) {
            return $query->where('nis', 'like', "%$search%")
                         ->orWhere('nama', 'like', "%$search%");
        })->paginate(10);

        return view('projek.table', compact('karyawans', 'search'));
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus.');
    }
}

