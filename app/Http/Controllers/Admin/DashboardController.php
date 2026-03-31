<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use App\Models\Log;

class DashboardController extends Controller
{
    public function index()
    {
        // STATISTIK UTAMA
        $totalUser = User::count();
        $totalAlat = Alat::count();
        $totalPeminjaman = Peminjaman::count();
        $dipinjam = Peminjaman::where('status','dipinjam')->count();
        $selesai = Peminjaman::where('status','selesai')->count();
        $pending = Peminjaman::where('status','pending')->count();
        $disetujui = Peminjaman::where('status','disetujui')->count();

        $totalDenda = Pengembalian::sum('denda');

        $pengembalianHariIni = Pengembalian::whereDate('created_at', today())->count();

        // DATA TABEL
        $users = User::latest()->take(5)->get();
        $logs = Log::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalAlat',
            'totalPeminjaman',
            'dipinjam',
            'selesai',
            'pending',
            'disetujui',
            'totalDenda',
            'pengembalianHariIni',
            'users',
            'logs'
        ));
    }
}