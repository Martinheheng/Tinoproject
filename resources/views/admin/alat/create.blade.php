@extends('layouts.admin')
@section('title', 'Tambahn Alat')
@section('content')

<h1 class="text-xl font-bold mb-4">Tambah Alat</h1>
<form action="{{route ('admin.alat.store')}}" method="POST" 
enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama_alat" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <select name="kategori_id" class="w-full border p-2 rounded">
            <option value="--Pilih Kategori--"></option>
            @foreach($kategoris as $k)
            <option value="{{$k->id}}">
                {{ $k->nama_kategori }}
            </option>
            @endforeach
        </select>

    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga_sewa" class="w-full border p-2 rounded" min="10000" step="5000">
    </div>
    <div class="mb-3">
        <label>deskripsi</label>
        <input type="text" name="deskripsi" class="w-full border p-2 rounded" min="10000" step="5000">
    </div>
    <div class="mb-3">
        <label>Foto Alat</label>
        <input type="file" name="foto_alat" class="w-full border p-2 rounded">
    </div>
    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>
@endsection
