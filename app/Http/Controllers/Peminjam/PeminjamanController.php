<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $transaksis = Peminjaman::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('peminjam.peminjaman.index', compact('transaksis'));
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
            'payment_method' => 'required|in:card,transfer,cod',
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
                'metode_pembayaran' => $request->payment_method,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_pengembalian' => $request->tanggal_kembali,
                'status' => 'menunggu',
            ]);
            
            $peminjaman_detail = PeminjamanDetails::create([
                'peminjaman_id' => $peminjaman->id,
                'alat_id' => $request->alat_id,
                "jumlah" => $request->jumlah_alat
            ]);

            $peminjaman_detail->alat()->decrement('stok', $request->jumlah_alat);

            DB::commit();
            return redirect()->route('peminjam.transaksi-berhasil', ['id_transaksi' => $peminjaman->id])
                ->with('success', 'Pengajuan peminjaman berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return redirect()->back()
                ->with('error', 'Pengajuan peminjaman gagal dibuat: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->where('user_id', auth()->user()->id)->with('peminjaman_details.alat')->first();

        $peminjaman['jumlah_hari'] = Carbon::parse($peminjaman->tanggal_pengembalian)->diffInDays(Carbon::parse($peminjaman->tanggal_pinjam));
        return view('peminjam.transaksi-berhasil', compact('peminjaman'));
    }
}
