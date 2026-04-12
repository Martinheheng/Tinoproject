@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-2xl shadow p-6 mb-6">

    <h2 class="text-xl font-semibold text-gray-800 mb-4">
        Log Aktivitas
    </h2>

    <!-- 🔍 FILTER -->
    <form method="GET" class="grid grid-cols-4 gap-4 mb-6">

        <input type="text" name="aksi" value="{{ request('aksi') }}"
            placeholder="Cari aksi..."
            class="border rounded-lg px-3 py-2 text-sm">

        <select name="role" class="border rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Role</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
            <option value="peminjam" {{ request('role') == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
        </select>

        <input type="date" name="tanggal" value="{{ request('tanggal') }}"
            class="border rounded-lg px-3 py-2 text-sm">

        <div class="flex gap-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                Filter
            </button>

            <a href="{{ route('admin.log.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                Reset
            </a>
        </div>

    </form>

    <!-- 📊 TOTAL -->
    <div class="mb-4 text-sm text-gray-600">
        Total Log: <span class="font-semibold">{{ $logs->total() }}</span>
    </div>

    <!-- 📋 TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">

            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Aksi</th>
                    <th class="px-6 py-3">Deskripsi</th>
                    <th class="px-6 py-3">Waktu</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @forelse($logs as $log)
                <tr class="hover:bg-gray-50">

                    <!-- USER -->
                    <td class="px-6 py-4">
                        {{ $log->user->name ?? '-' }}
                    </td>

                    <!-- ROLE BADGE -->
                    <td class="px-6 py-4">
                        @if($log->role == 'admin')
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">Admin</span>
                        @elseif($log->role == 'petugas')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Petugas</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Peminjam</span>
                        @endif
                    </td>

                    <!-- AKSI -->
                    <td class="px-6 py-4 font-medium">
                        {{ $log->aksi }}
                    </td>

                    <!-- DESKRIPSI -->
                    <td class="px-6 py-4">
                        {{ $log->deskripsi }}
                    </td>

                    <!-- WAKTU -->
                    <td class="px-6 py-4 text-gray-500">
                        {{ $log->created_at->format('d M Y H:i') }}
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">
                        Belum ada log aktivitas 😴
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>

    <!-- 📄 PAGINATION -->
    <div class="mt-6">
        {{ $logs->links() }}
    </div>

</div>

@endsection