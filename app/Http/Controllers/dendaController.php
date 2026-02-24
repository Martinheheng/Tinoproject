<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman; 

class dendaController extends Controller
{
    public function prosesKembali($id) {
    $peminjaman = Peminjaman::with('alat')->find($id);
    
    $tgl_deadline = $peminjaman->tanggal_pengembalian;  
    $tgl_sekarang = now();
    $harga_barang = $peminjaman->alat->harga_sewa; 

    $total_denda = hitung_denda($tgl_deadline, $tgl_sekarang, $harga_barang);

    $peminjaman->pengembalian()->create([
        'tanggal_pengembalian' => $tgl_sekarang,
        'denda' => $total_denda,
        'kondisi' => 'baik'
    ]);
}
}
