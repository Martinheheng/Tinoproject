@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-6">Edit User</h2>

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- NAMA -->
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}"
                class="w-full border p-2 rounded">
        </div>

        <!-- EMAIL -->
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ $user->email }}"
                class="w-full border p-2 rounded">
        </div>

        <!-- PASSWORD -->
        <div class="mb-4">
            <label class="block mb-1">Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password"
                class="w-full border p-2 rounded">
        </div>

        <!-- NO TELP -->
        <div class="mb-4">
            <label class="block mb-1">No Telepon</label>
            <input type="text" name="no_telp" value="{{ $user->no_telp }}"
                class="w-full border p-2 rounded">
        </div>

        <!-- ALAMAT -->
        <div class="mb-4">
            <label class="block mb-1">Alamat</label>
            <textarea name="alamat" class="w-full border p-2 rounded">{{ $user->alamat }}</textarea>
        </div>

        <!-- ROLE -->
        <div class="mb-4">
            <label class="block mb-1">Role</label>
            <select name="role" class="w-full border p-2 rounded">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <!-- BUTTON -->
        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update
        </button>

    </form>
</div>
@endsection