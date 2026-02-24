@extends('layouts.app')

@section('content')
<h2>Dashboard Peminjam</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap; margin-top:20px;">

    <a href="{{ route('peminjam.peminjaman.index') }}"
       style="padding:20px; border:1px solid #ccc; text-decoration:none;">
        📋 Ajukan Peminjaman
    </a>

    <a href="#"
       style="padding:20px; border:1px solid #ccc; text-decoration:none;">
        🔄 Pengembalian Alat
    </a>

</div>
@endsection
