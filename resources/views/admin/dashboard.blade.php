@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('content')
        <!-- STATISTIK -->

        <div class="grid grid-cols-4 gap-6 mb-10">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500 text-sm">Total User</h3>
                <p class="text-3xl font-bold mt-2">{{ $totalUser }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500 text-sm">Total Alat</h3>
                <p class="text-3xl font-bold mt-2">{{ $totalAlat }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500 text-sm">Total Peminjaman</h3>
                <p class="text-3xl font-bold mt-2">{{ $totalPeminjaman }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500 text-sm">Pengembalian Hari Ini</h3>
                <p class="text-3xl font-bold mt-2">{{ $pengembalianHariIni }}</p>
            </div>

        </div>

      
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

            <tbody class="divide-y divide-gray-200">

            @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $user->name }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $user->email }}
                    </td>

                    <td class="px-6 py-4">
                        @if($user->role == 'admin')
                            <span class="bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full font-semibold">
                                Admin
                            </span>
                        @elseif($user->role == 'petugas')
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-semibold">
                                Petugas
                            </span>
                        @else
                            <span class="bg-green-100 text-green-600 text-xs px-3 py-1 rounded-full font-semibold">
                                User
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.user.edit', $user->id) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs font-medium transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.user.destroy', $user->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Yakin hapus user ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs font-medium transition">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-400">
                        Belum ada data user
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
        <!-- TABEL LOG AKTIVITAS -->
<div class="bg-white rounded-2xl shadow p-6">
    
    <h2 class="text-xl font-semibold text-gray-800 mb-6">
        Log Aktivitas Sistem
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">

            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Aktivitas</th>
                    <th class="px-6 py-3">Tanggal</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

            @forelse($logs as $log)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $log->user->name ?? 'System' }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $log->aktivitas }}
                    </td>

                    <td class="px-6 py-4 text-gray-500 text-xs">
                        {{ $log->created_at->format('d M Y H:i') }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-6 text-center text-gray-400">
                        Belum ada log aktivitas
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection