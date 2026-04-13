@extends('layouts.admin')

@section('content')

<!-- 🔥 STATISTIK -->
<div class="grid grid-cols-4 gap-6 mb-10">

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Total User</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalUser ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Total Alat</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalAlat ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Total Peminjaman</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalPeminjaman ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500 text-sm">Pengembalian Hari Ini</h3>
        <p class="text-3xl font-bold mt-2">{{ $pengembalianHariIni ?? 0 }}</p>
    </div>

</div>


<!-- 👤 MANAJEMEN USER -->
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
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>

                    <td class="px-6 py-4">
                        @if($user->role == 'admin')
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">Admin</span>
                        @elseif($user->role == 'petugas')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Petugas</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Peminjam</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-center flex justify-center gap-2">

                        <a href="{{ route('admin.user.edit', $user->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 px-3 py-1 rounded text-xs">
                            Edit
                        </a>

                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Data kosong (database kamu lagi santai 😴)
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>


<!-- 📜 LOG AKTIVITAS (PREVIEW) -->
<div class="bg-white rounded-2xl shadow p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            Log Aktivitas Terbaru
        </h2>

        <a href="{{ route('admin.log.index') }}"
           class="text-blue-600 hover:underline text-sm">
            Lihat Semua →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">

            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Aksi</th>
                    <th class="px-6 py-3">Waktu</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @forelse($log_aktifitas as $log)
                <tr class="hover:bg-gray-50">

                    <td class="px-6 py-4">
                        {{ $log->user->name ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        @if($log->role == 'admin')
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">Admin</span>
                        @elseif($log->role == 'petugas')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Petugas</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Peminjam</span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        {{ $log->aksi }}
                    </td>

                    <td class="px-6 py-4 text-gray-500">
                        {{ $log->created_at->diffForHumans() }}
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Belum ada aktivitas 😴
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>

</div>

@endsection