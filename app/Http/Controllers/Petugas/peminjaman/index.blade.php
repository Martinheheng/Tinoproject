@extends('layouts.app')

@section('content')
<h2>Persetujuan Peminjaman</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama Peminjam</th>
        <th>Alat</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($peminjamans as $peminjaman)
    <tr>
        <td>{{ $peminjaman->user->name }}</td>
        <td>{{ $peminjaman->alat->nama }}</td>
        <td>{{ $peminjaman->status }}</td>
        <td>
            <form method="POST" action="{{ route('petugas.peminjaman.approve', $peminjaman->id) }}">
                @csrf
                <button type="submit">Approve</button>
            </form>

            <form method="POST" action="{{ route('petugas.peminjaman.reject', $peminjaman->id) }}">
                @csrf
                <button type="submit">Reject</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
