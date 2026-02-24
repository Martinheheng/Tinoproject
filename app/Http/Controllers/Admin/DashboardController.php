<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlat = Alat::count();
        $totalPeminjaman = Peminjaman::count();
        $dipinjam = Peminjaman::where('status','dipinjam')->count();
        $selesai = Peminjaman::where('status','selesai')->count();
        $totalDenda = Pengembalian::sum('denda');
        // DATA UNTUK CHART
        $pending = Peminjaman::where('status','pending')->count();
        $disetujui = Peminjaman::where('status','disetujui')->count();
        return view('admin.dashboard', compact(
    'totalAlat',
    'totalPeminjaman',
    'dipinjam',
    'selesai',
    'totalDenda',
    'pending',
    'disetujui'
        ));
    }
}
