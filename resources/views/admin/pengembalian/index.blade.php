@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-2xl shadow p-6">

    <h2 class="text-xl font-semibold text-gray-800 mb-6">
        Daftar Pengembalian
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">

            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Alat</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

            @forelse($peminjaman as $item)
                <tr class="hover:bg-gray-50 transition">

                    <!-- USER -->
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $item->user->name ?? '-' }}
                    </td>

                    <!-- ALAT -->
                    <td class="px-6 py-4 text-gray-600">
                        {{ $item->alat->nama ?? '-' }}
                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-4">
                        @if($item->status == 'dipinjam')
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full font-semibold">
                                Dipinjam
                            </span>
                        @elseif($item->status == 'dikembalikan')
                            <span class="bg-green-100 text-green-600 text-xs px-3 py-1 rounded-full font-semibold">
                                Dikembalikan
                            </span>
                        @else
                            <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full font-semibold">
                                {{ ucfirst($item->status) }}
                            </span>
                        @endif
                    </td>

                    <!-- AKSI -->
                    <td class="px-6 py-4 text-center">

                        @if($item->status == 'dipinjam')
                            <form action="{{ route('admin.pengembalian.kembalikan', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin mengembalikan alat ini?')">
                                @csrf
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-medium transition">
                                    Kembalikan
                                </button>
                            </form>
                        @else
                            <button disabled
                                class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-xs font-medium cursor-not-allowed">
                                Selesai
                            </button>
                        @endif

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">
                        Tidak ada data pengembalian.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection