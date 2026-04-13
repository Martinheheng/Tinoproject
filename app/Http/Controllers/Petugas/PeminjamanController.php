<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:petugas');
    }

    // Menampilkan daftar peminjaman yang menunggu persetujuan
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'details.alat'])
                        ->where('status', 'menunggu')
                        ->latest()
                        ->get();
        return view('petugas.peminjaman.index', compact('peminjaman'));
    }

    // Menyetujui peminjaman
    public function approve($id)
    {
        $peminjaman = Peminjaman::with('details.alat')->findOrFail($id);

        if ($peminjaman->details->isEmpty()) {
            return back()->with('error', 'Tidak ada detail alat dalam peminjaman ini.');
        }

        DB::beginTransaction();
        try {
            foreach ($peminjaman->details as $detail) {
                $alat = $detail->alat;
                if (!$alat) {
                    throw new \Exception("Alat dengan ID {$detail->alat_id} tidak ditemukan.");
                }
                if ($alat->stok < $detail->jumlah) {
                    throw new \Exception("Stok {$alat->nama_alat} tidak mencukupi (butuh {$detail->jumlah}, tersisa {$alat->stok}).");
                }
                $alat->decrement('stok', $detail->jumlah);
            }

            $peminjaman->update([
                'status' => 'disetujui',
                'petugas_id' => auth()->id()
            ]);

            DB::commit();
            return back()->with('success', 'Peminjaman disetujui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyetujui: '.$e->getMessage());
        }
    }

    // Menolak peminjaman
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'status' => 'ditolak',
            'petugas_id' => auth()->id()
        ]);
        return back()->with('success', 'Peminjaman ditolak.');
    }

    // Menampilkan daftar peminjaman yang perlu dipantau pengembaliannya
    public function pengembalianIndex()
    {
        $peminjaman = Peminjaman::with(['user', 'details.alat'])
                        ->whereIn('status', ['disetujui', 'dipinjam'])
                        ->latest()
                        ->get();
        return view('petugas.pengembalian.index', compact('peminjaman'));
    }

    // Proses pengembalian
    public function prosesKembali(Request $request, $id)
    {
        $request->validate([
            'tanggal_kembali_real' => 'required|date',
            'denda' => 'nullable|integer|min:0'
        ]);

        $peminjaman = Peminjaman::with('details.alat')->findOrFail($id);

        DB::beginTransaction();
        try {
            // Kembalikan stok untuk setiap detail
            foreach ($peminjaman->details as $detail) {
                $detail->alat->increment('stok', $detail->jumlah);
            }

            // Catat pengembalian (pastikan tabel pengembalian punya kolom petugas_id)
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id_peminjaman,
                'tanggal_kembali_real' => $request->tanggal_kembali_real,
                'denda' => $request->denda ?? 0,
                'catatan' => $request->catatan,
                'petugas_id' => auth()->id()
            ]);

            $peminjaman->update(['status' => 'dikembalikan']);

            DB::commit();
            return back()->with('success', 'Pengembalian berhasil dicatat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses: '.$e->getMessage());
        }
    }

    // Laporan (tidak berubah)
    public function laporanIndex()
    {
        return view('petugas.laporan.index');
    }

    public function laporanCetak(Request $request)
    {
        // ... sama seperti sebelumnya
    }
}
