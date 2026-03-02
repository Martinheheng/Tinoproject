<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\alat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $alat = alat::get(['id', 'foto_alat','nama_alat', 'stok', 'harga_sewa']);
        return view('peminjam.dashboard', compact('alat'));
    }
}
