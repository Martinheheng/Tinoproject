<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\kategori;

class PeminjamanController extends Controller
{

public function index(Request $request)
{
    $query = Alat::with(['kategori', 'peminjamans' => function($q) {
        $q->where('user_id', auth()->id())
          ->whereIn('status', ['menunggu','dipinjam']);
    }]);

    if ($request->search) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    if ($request->kategori) {
        $query->where('kategori_id', $request->kategori);
    }

    $alats = $query->latest()->paginate(8)->withQueryString();
    $kategoris = Kategori::all();

    return view('peminjam.peminjaman.index', compact('alats', 'kategoris'));
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
    public function show($id)
{
    $peminjaman = Peminjaman::with('alat.kategori')
        ->where('user_id', auth()->id())
        ->findOrFail($id);

    return view('peminjam.show', compact('peminjaman'));
}
}
