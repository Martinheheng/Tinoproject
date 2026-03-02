<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $alats = Alat::where('stok', '>', 0)->get();
        return view('peminjam.peminjaman.index', compact('alats'));
    }

    public function create(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);
        $alat['qty'] = $request->qty;
        $alat['total_sewa'] = $request->qty * $alat->harga_sewa;
        return view('peminjam.proses-penyewaan', compact('alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alat,id',
            'jumlah_alat' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $alat = Alat::findOrFail($request->alat_id);
            $subtotal = $request->jumlah_alat * Alat::find($request->alat_id)->harga_sewa;
            
            $peminjaman = Peminjaman::create([
                'user_id' => auth()->user()->id,
                'subtotal' => $subtotal,
                'deposit' => $subtotal * 0.5,
                'total' => $subtotal + ($subtotal * 0.5),
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_pengembalian' => $request->tanggal_kembali,
                'status' => 'menunggu',
            ]);

            $peminjaman->alat()->attach($alat, ['jumlah' => $request->jumlah_alat]);

            DB::commit();
            return redirect()->route('peminjam.transaksi-berhasil')
                ->with('success', 'Pengajuan peminjaman berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Pengajuan peminjaman gagal dibuat: ' . $e->getMessage());
        }
    }
}
