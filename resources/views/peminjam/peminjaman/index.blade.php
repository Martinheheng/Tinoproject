@extends('layouts.app', ['title' => 'Riwayat Transaksi', 'dengan_sidebar' => true])

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Riwayat Transaksi
                </h2>
                <p class="text-sm text-gray-500">
                    Total {{ $transaksis->count() }} transaksi
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">User</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Metode</th>
                        <th class="px-4 py-3 text-left">Pinjam</th>
                        <th class="px-4 py-3 text-left">Kembali</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Denda</th>
                        <th class="px-4 py-3 text-left">Dikembalikan</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($transaksis as $trx)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-4 py-3 font-semibold text-indigo-600">
                            #{{ $trx->id_peminjaman }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $trx->user_id }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="font-semibold text-gray-800">
                                Rp {{ number_format($trx->total, 0, ',', '.') }}
                            </div>
                            <div class="text-xs text-gray-400">
                                Subtotal: Rp {{ number_format($trx->subtotal, 0, ',', '.') }}
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-600">
                                {{ $trx->metode_pembayaran }}
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($trx->tanggal_pengembalian)->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3">
                            @if($trx->status == 'selesai')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600">
                                    Selesai
                                </span>
                            @elseif($trx->status == 'proses')
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600">
                                    Proses
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-600">
                                    Dibatalkan
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            @if($trx->denda > 0)
                                <span class="text-red-600 font-semibold">
                                    Rp {{ number_format($trx->denda, 0, ',', '.') }}
                                </span>
                                <div class="text-xs text-red-400">
                                    Terlambat {{ $trx->total_terlambat }} hari
                                </div>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            @if($trx->dikembalikan_pada)
                                {{ \Carbon\Carbon::parse($trx->dikembalikan_pada)->format('d M Y') }}
                            @else
                                <span class="text-gray-400">Belum</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <a href="{{ route('peminjam.transaksi-berhasil', ['id_transaksi' => $trx->id_peminjaman]) }}" class="text-indigo-600 hover:underline text-sm">
                                Detail
                            </a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t">
            {{ $transaksis->links() }}
        </div>

    </div>
</div>
@endsection