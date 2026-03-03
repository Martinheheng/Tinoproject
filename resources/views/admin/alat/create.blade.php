@extends('layouts.app')

@section('content')

<h2>Tambah Alat</h2>
@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('admin.alat.store') }}">
    @csrf

    <input type="text" name="nama_alat" placeholder="Nama Alat"><br><br>
            <label>Kategori</label>
        <select name="kategori_id">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select>
        <br><br>
    <input type="number" name="stok" placeholder="Stok"><br><br>
    <input type="number" step="0.01" name="harga_sewa" placeholder="Harga Sewa"><br><br>
    <textarea name="deskripsi" placeholder="Deskripsi"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

@endsection
