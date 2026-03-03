@extends('layouts.app')

@section('content')
<h2>Daftar Pengembalian</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Alat</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($peminjaman as $item)
    <tr>
        <td>{{ $item->user->name ?? '-' }}</td>
        <td>{{ $item->alat->nama ?? '-' }}</td>
        <td>{{ $item->status }}</td>
        <td>
            <form action="{{ route('admin.pengembalian.kembalikan', $item->id) }}" method="POST">
                @csrf
                <button type="submit">Kembalikan</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection