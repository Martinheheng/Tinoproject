@extends('layouts.app')

@section('content')

<h2>Data Kategori</h2>

<a href="{{ route('admin.kategori.create') }}">+ Tambah</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    @foreach($kategoris as $kategori)
    <tr>
        <td>{{ $kategori->nama_kategori }}</td>
        <td>
            <a href="{{ route('admin.kategori.edit', $kategori->id) }}">Edit</a>

            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
