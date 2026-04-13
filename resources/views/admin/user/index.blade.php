@extends('layouts.admin')
@section('content')
<div class="bg-white rounded-2xl shadow p-6 mb-10">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            Manajemen User
        </h2>
 
        <a href="{{ route('admin.user.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            + Tambah User
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">

            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="p-2 border">{{$user->name}}</td>
                    <td class="p-2 border">{{$user->email}}</td>
                    <td class="p-2 border">{{$user->role}}</td>

                    <td class="P-2 border flex gap-2">
                        <a href="{{route ('admin.user.edit', $user->id) }}" 
                            class="bg-green-400 px-2 py-2 rounded text-sm">
                            Edit
                        </a>
                        <form action="{{route ('admin.user.destroy', $user->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-2 rounded text-sm ">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
@endsection