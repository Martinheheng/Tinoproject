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
        // Perbaikan: 'user' bukan 'users', 'details' bukan 'details_alat'
        $transaksis = Peminjaman::with(['user', 'details'])
                    ->where('status', 'menunggu')
                    ->latest()
                    ->paginate(10);
        return view('petugas.peminjaman.index', compact('transaksis'));
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
        // Perbaikan: gunakan 'user' dan 'details' sesuai relasi
        $peminjaman = Peminjaman::with(['user', 'details'])
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
                'peminjaman_id' => $peminjaman->id, // perbaikan: gunakan 'id' jika itu primary key
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

    // Laporan - menampilkan form filter
    public function laporanIndex()
    {
        return view('petugas.laporan.index');
    }

    // Laporan - cetak PDF
    public function laporanCetak(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $query = Peminjaman::with(['user', 'details.alat']);

        // Filter tanggal
        $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);

        // Filter status (jika ada)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjaman = $query->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('petugas.laporan.cetak', compact('peminjaman', 'request'));
        return $pdf->download('laporan_peminjaman_' . date('Y-m-d') . '.pdf');
    }
}