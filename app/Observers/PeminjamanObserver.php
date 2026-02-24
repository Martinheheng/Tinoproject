<?php

namespace App\Observers;

use App\Models\Log_aktifitas;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class PeminjamanObserver
{
    public function created(Peminjaman $peminjaman)
    {
        Log_aktifitas::create([
            'user_id'   => $peminjaman->user_id,
            'aksi'      => 'pinjam',
            'deskripsi' => 'Mengajukan peminjaman alat ID: ' . $peminjaman->alat_id,
            'waktu'     => now(),
        ]);
    }

    public function updated(Peminjaman $peminjaman)
    {
        if ($peminjaman->isDirty('status')) {

            $status = $peminjaman->status;
            $alat   = $peminjaman->alat;

            // 🔥 Saat Dipinjam → Kurangi stok
            if ($status === 'dipinjam') {
                $alat->decrement('stok', $peminjaman->jumlah);
            }

            // 🔥 Saat Selesai → Kembalikan stok + Hitung denda
            if ($status === 'selesai') {

                $alat->increment('stok', $peminjaman->jumlah);

                $denda = hitung_denda(
                    $peminjaman->tanggal_kembali_rencana,
                    now(),
                    $alat->harga_sewa
                );

                $peminjaman->updateQuietly([
                    'tanggal_kembali_real' => now(),
                    'total_denda' => $denda
                ]);
            }

            // 🔥 Log perubahan status
            Log_aktifitas::create([
                'user_id'   => Auth::id(),
                'aksi'      => $status,
                'deskripsi' => 'Status peminjaman berubah menjadi ' . $status,
                'waktu'     => now(),
            ]);
        }
    }
}
