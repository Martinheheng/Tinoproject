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
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'payment_method' => 'required|in:card,transfer,cod',
        ]);

        return DB::transaction(function () use ($request) {

            $alat = Alat::lockForUpdate()->findOrFail($request->alat_id);

            if ($alat->stok < $request->jumlah_alat) {
                throw new \Exception("Stok {$alat->nama_alat} tidak mencukupi.");
            }

            $durasi = Carbon::parse($request->tanggal_pinjam)
                ->diffInDays(Carbon::parse($request->tanggal_kembali));

            if ($durasi <= 0) {
                throw new \Exception("Durasi tidak valid.");
            }

            $subtotal = $alat->harga_sewa * $request->jumlah_alat * $durasi;
            $deposit = $subtotal * 0.5;
            $total = $subtotal - $deposit;

            $peminjaman = Peminjaman::create([
                'user_id' => auth()->id(),
                'subtotal' => $subtotal,
                'deposit' => $deposit,
                'total' => $total,
                'metode_pembayaran' => $request->payment_method,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_pengembalian' => $request->tanggal_kembali,
                'status' => 'menunggu'
            ]);

            PeminjamanDetails::create([
                'peminjaman_id' => $peminjaman->id,
                'alat_id' => $alat->id,
                'jumlah' => $request->jumlah_alat
            ]);

            $alat->decrement('stok', $request->jumlah_alat);

            return redirect()->route('peminjam.transaksi-berhasil', $peminjaman->id);
        });
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->where('user_id', auth()->user()->id)->with('peminjaman_details.alat')->first();

        $peminjaman['jumlah_hari'] = Carbon::parse($peminjaman->tanggal_pengembalian)->diffInDays(Carbon::parse($peminjaman->tanggal_pinjam));
        return view('peminjam.transaksi-berhasil', compact('peminjaman'));
    }
}
