@extends('layouts.app')

@section('content')
<h2>Daftar Alat</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama Alat</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($alats as $alat)
    <tr>
        <td>{{ $alat->nama }}</td>
        <td>{{ $alat->kategori->nama ?? '-' }}</td>
        <td>{{ $alat->status }}</td>
        <td>
            <a href="{{ route('peminjam.peminjaman.create', $alat->id) }}">
                Pinjam
            </a>
        </td>
    </tr>
    @endforeach

</table>
@endsection
