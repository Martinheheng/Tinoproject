<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\pengembalian;
use App\Models\User;
use App\Models\Log_aktifitas;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalAlat = Alat::count();
        $totalPeminjaman = Peminjaman::count();
        $pengemmbalianHariini = pengembalian::count();

        $users = User::latest()->get();
        $log_aktifitas = Log::with('user')->latest()->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalAlat',
            'totalPeminjaman',
            'pengemmbalianHariini',
            'user',
            'log_aktifitas'
        ));
    }
    public function create()
    {
        
    }
}
