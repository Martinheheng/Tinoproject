@extends('layouts.admin')
@section('title', 'Tambahn User')
@section('content')

<h1 class="text-xl font-bold mb-4">Tambah User</h1>
<form action="{{route ('admin.user.store')}}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="w-full border p-2 rounded">
    </div>
    <div class="mb-3">
        <label>No Telepon</label>
        <input type="number" name="telepon" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="w-full border p-2 rounded">
    </div>
    
    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="w-full border p-2 rounded">
            <option value="admin">Admin</option>
            <option value="peminjam">Peminjam</option>
            <option value="petugas">Petugas</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="w-full border p-2 rounded">
    </div>
    
    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>
@endsection
