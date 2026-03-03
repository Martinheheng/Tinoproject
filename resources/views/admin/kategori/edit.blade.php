@extends('layouts.app')

@section('content')
<h2>Edit Kategori</h2>

<form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori"
               value="{{ $kategori->nama_kategori }}" required>
    </div>

    <br>
    <button type="submit">Update</button>
</form>
@endsection
