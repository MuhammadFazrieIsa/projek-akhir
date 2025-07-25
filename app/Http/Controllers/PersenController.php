<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absen;
use Illuminate\Support\Carbon;

class PersenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'asc'); // Default: earliest to latest

        // Get attendance records with user info
        $absens = Absen::with('user')
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                      ->orWhere('rfid_uid', 'like', "%$search%");
                });
            })
            ->orderBy('kedatangan', $sort)
            ->paginate(10);

        $today = Carbon::today();

        // Dashboard stats
        $todayPresent = Absen::whereDate('tanggal', $today)
            ->where('status_kehadiran', 'Hadir')
            ->count();

        $totalUser = User::count();

        $terlambatHariIni = Absen::whereDate('tanggal', $today)
            ->where('status_kedatangan', 'Terlambat')
            ->count();

        $hadirHariIni = Absen::whereDate('tanggal', $today)->count();

        $tidakHadir = $totalUser - $hadirHariIni;

        return view('projek2.dashboard', compact(
            'absens',
            'search',
            'sort',
            'todayPresent',
            'totalUser',
            'terlambatHariIni',
            'tidakHadir'
        ));
    }
}
