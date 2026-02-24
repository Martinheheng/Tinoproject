@extends('layouts.app')

@section('content')
<h2>Dashboard Petugas</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap; margin-top:20px;">

    <a href="{{ route('petugas.peminjaman.index') }}"
       style="padding:20px; border:1px solid #ccc; text-decoration:none;">
        📋 Kelola Peminjaman
    </a>

    <a href="#"
       style="padding:20px; border:1px solid #ccc; text-decoration:none;">
        🔄 Monitor Pengembalian
    </a>

    <a href="#"
       style="padding:20px; border:1px solid #ccc; text-decoration:none;">
        🖨 Cetak Laporan
    </a>

</div>
@endsection
