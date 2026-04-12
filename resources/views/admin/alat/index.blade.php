@extends('layouts.admin')

@section('content')

<h2>Data Alat</h2>

<a href="{{ route('admin.alat.create') }}">+ Tambah Alat</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    @foreach($alats as $alat)
    <tr>
        <td>{{ $alat->nama_alat }}</td>
        <td>
        {{ $alat->kategori->nama_kategori ?? '-' }}
        </td>
        <td>{{ $alat->stok }}</td>
        <td>{{ $alat->harga_sewa }}</td>
        <td>
            <a href="{{ route('admin.alat.edit', $alat->id) }}">Edit</a>  
            <form action="{{ route('admin.alat.destroy', $alat->id) }}" 
      method="POST" 
      style="display:inline;"
      onsubmit="return confirm('Yakin mau hapus alat ini?')">
    @csrf
    @method('DELETE')
    <button type="submit">Hapus</button>
</form>
        </td>
    </tr>
    @endforeach
</table>


@endsection
