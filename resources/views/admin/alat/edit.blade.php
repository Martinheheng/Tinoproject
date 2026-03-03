@extends('layouts.app')

@section('content')

<h2>Edit Alat</h2>

<form method="POST" action="{{ route('admin.alat.update', $alat->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="nama_alat" value="{{ $alat->nama_alat }}"><br><br>
    <label>Kategori</label>
<select name="kategori_id">
    @foreach($kategoris as $kategori)
        <option value="{{ $kategori->id }}"
            {{ $alat->kategori_id == $kategori->id ? 'selected' : '' }}>
            {{ $kategori->nama_kategori }}
        </option>
    @endforeach
</select>

    <input type="number" name="stok" value="{{ $alat->stok }}"><br><br>
    <input type="number" step="0.01" name="harga_sewa" value="{{ $alat->harga_sewa }}"><br><br>
    <textarea name="deskripsi">{{ $alat->deskripsi }}</textarea><br><br>

    <button type="submit">Update</button>
</form>

@endsection
