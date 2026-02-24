<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $alats = Alat::where('stok', '>', 0)->get();
        return view('peminjam.peminjaman.index', compact('alats'));
    }

    public function create($id)
    {
        $alat = Alat::findOrFail($id);
        return view('peminjam.peminjaman.create', compact('alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after:tanggal_pinjam'
        ]);

        Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $request->alat_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'status' => 'menunggu'
        ]);

        return redirect()->route('peminjam.peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil dibuat');
    }
}
