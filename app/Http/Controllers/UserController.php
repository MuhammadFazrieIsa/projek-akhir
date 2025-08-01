<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absen;

class UserController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');
     $sort = $request->input('sort', 'desc'); // default desc

    
    $users = User::with(['absenTerbaru' => function ($query) use ($sort) {
                    $query->orderBy('tanggal', $sort);
        }])
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                         ->orWhere('rfid_uid', 'like', "%$search%");
        })
        ->paginate(10);

    return view('projek2.table', compact('users', 'search', 'sort'));
    
}


    public function destroy($id)
    {
        $karyawan = User::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan')->with('success', 'Data berhasil dihapus.');
    }
    
}

