@extends('layouts.admin')

@section('content')

<div class="max-w-2xl bg-white p-8 rounded-2xl shadow">

    <h2 class="text-xl font-bold mb-6">Tambah Alat</h2>

    <form method="POST"
          action="{{ route('admin.alat.store') }}"
          enctype="multipart/form-data">
        @csrf

        <!-- Nama Alat -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Nama Alat</label>
            <input type="text"
                   name="nama_alat"
                   value="{{ old('nama_alat') }}"
                   class="w-full border rounded-lg px-4 py-2">
            @error('nama_alat')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Kategori</label>
            <select name="kategori_id"
                    class="w-full border rounded-lg px-4 py-2">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Stok -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Stok</label>
            <input type="number"
                   name="stok"
                   value="{{ old('stok') }}"
                   class="w-full border rounded-lg px-4 py-2">
            @error('stok')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Harga Sewa</label>
            <input type="number"
                   step="0.01"
                   name="harga_sewa"
                   value="{{ old('harga_sewa') }}"
                   class="w-full border rounded-lg px-4 py-2">
            @error('harga_sewa')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Deskripsi</label>
            <textarea name="deskripsi"
                      class="w-full border rounded-lg px-4 py-2"
                      rows="3">{{ old('deskripsi') }}</textarea>
        </div>

        <!-- Upload Gambar -->
        <div class="mb-6">
            <label class="block text-sm mb-1">Gambar Alat</label>
            <input type="file"
                   name="gambar"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.alat.index') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded-lg">
                Kembali
            </a>

            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                Simpan
            </button>
        </div>

    </form>
</div>

@endsection