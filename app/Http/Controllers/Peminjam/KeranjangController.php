<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\keranjang;
use App\Models\keranjang_items;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    private function getCart()
    {
        return keranjang::firstOrCreate([
            'user_id' => auth()->id()
        ]);
    }

    public function index()
    {
        $keranjang = $this->getCart()->load('keranjang_items.alat');
        return view('peminjam.keranjang', compact('keranjang'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alat,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        $keranjang = $this->getCart();

        $existing = $keranjang->keranjang_items()
            ->where('alat_id', $request->alat_id)
            ->first();

        if ($existing) {
            $existing->update([
                'jumlah' => $existing->jumlah + $request->jumlah
            ]);
        } else {
            keranjang_items::create([
                'keranjang_id' => $keranjang->id,
                'alat_id' => $request->alat_id,
                'jumlah' => $request->jumlah
            ]);
        }

        return back()->with('success', 'Ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $item = keranjang_items::findOrFail($id);
        $item->update(['jumlah' => $request->jumlah]);

        return back();
    }

    public function remove($id)
    {
        keranjang_items::findOrFail($id)->delete();
        return back();
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'metode_pembayaran' => 'required'
        ]);

        $keranjang = $this->getCart()->load('keranjang_items.alat');

        if ($keranjang->keranjang_items->count() == 0) {
            return back()->with('error', 'Keranjang kosong');
        }

        $durasi = \Carbon\Carbon::parse($request->tanggal_pinjam)
            ->diffInDays(\Carbon\Carbon::parse($request->tanggal_kembali));

        DB::transaction(function () use ($keranjang, $durasi, $request) {

            $subtotal = 0;

            foreach ($keranjang->keranjang_items as $item) {
                $subtotal += $item->alat->total_sewa * $durasi * $item->jumlah;
            }

            $deposit = $subtotal * 0.5;
            $total = $subtotal + $deposit;

            $peminjaman = Peminjaman::create([
                'user_id' => auth()->id(),
                'subtotal' => $subtotal,
                'deposit' => $deposit,
                'total' => $total,
                'metode_pembayaran' => $request->metode_pembayaran,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_pengembalian' => $request->tanggal_kembali,
                'status' => 'menunggu'
            ]);

            foreach ($keranjang->keranjang_items as $item) {
                PeminjamanDetails::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id' => $item->alat_id,
                    'jumlah' => $item->jumlah
                ]);
            }

            $keranjang->keranjang_items()->delete();
            
            return redirect()->route('peminjaman.transaksi-berhasil', ['id_transaksi' => $peminjaman->id])->with('success', 'Checkout berhasil');
        });

    }
}