<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('user','alat')
                        ->where('status', 'menunggu')
                        ->get();

        return view('petugas.peminjaman.index', compact('peminjaman'));
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // AUTO POTONG STOK
        $alat = $peminjaman->alat;

        if ($alat->stok < $peminjaman->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $alat->decrement('stok', $peminjaman->jumlah);

        $peminjaman->update([
            'status' => 'dipinjam'
        ]);

        return back()->with('success', 'Peminjaman disetujui');
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success', 'Peminjaman ditolak');
    }
}
