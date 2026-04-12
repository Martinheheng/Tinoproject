<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Models\Alat;
use App\Models\Log_aktifitas;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        $totalUser = User::count();
        $totalAlat = Alat::count();
        $totalPeminjaman = Peminjaman::count();

        $dipinjam = Peminjaman::where('status','dipinjam')->count();
        $selesai = Peminjaman::where('status','selesai')->count();
        $pending = Peminjaman::where('status','pending')->count();
        $disetujui = Peminjaman::where('status','disetujui')->count();

        $totalDenda = Pengembalian::sum('denda');
        $pengembalianHariIni = Pengembalian::whereDate('created_at', Carbon::today())->count();
        $log_aktifitas = Log_aktifitas::with('user')
                        ->latest()
                        ->take(5)
                        ->get();
        return view('admin.dashboard', compact(
            'users',
            'totalUser',
            'totalAlat',
            'log_aktifitas',
            'totalPeminjaman',
            'dipinjam',
            'selesai',
            'pending',
            'disetujui',
            'totalDenda',
            'pengembalianHariIni'
        ));
    }
}