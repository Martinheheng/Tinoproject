<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\pengembalian;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail( $id );

        if ($peminjaman->status === 'selesai') {
            return back ()->with('error','Peminjaman Sudah Dikembalikan.');
        }
    
        $peminjaman->update(['status'=> 'selesai']);
        return back ()->with('success','Pengembalian Berhasil Diproses.');
    }
    public function index()
    {
        $peminjaman = Peminjaman::where('status', 'dipinjam')->get();
        return view('admin.pengembalian.index', compact('peminjaman'));
    }
}
