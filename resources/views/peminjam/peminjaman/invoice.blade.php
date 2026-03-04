@extends('layouts.app', ['title' => 'Invoice'])

@section('content')
<div class="min-h-screen bg-slate-100 py-10 px-4">
    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">

            {{-- Header --}}
            <div class="bg-linear-to-r from-indigo-600 to-purple-600 p-8 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold">INVOICE</h1>
                        <p class="text-indigo-100 mt-1">
                            #INV-{{ $peminjaman->id }}
                        </p>
                    </div>

                    <div class="text-right text-sm">
                        <p>Status</p>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $peminjaman->status === 'dikembalikan'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-8 space-y-10">

                {{-- User Info --}}
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-sm text-slate-500 mb-2">Penyewa</h2>
                        <p class="font-semibold text-slate-800">
                            {{ $peminjaman->user->name }}
                        </p>
                        <p class="text-slate-600 text-sm">
                            {{ $peminjaman->user->email }}
                        </p>
                        <p class="text-slate-600 text-sm">
                            {{ $peminjaman->user->telepon }}
                        </p>
                        <p class="text-slate-600 text-sm">
                            {{ $peminjaman->user->alamat }}
                        </p>
                    </div>

                    <div class="md:text-right">
                        <h2 class="text-sm text-slate-500 mb-2">Detail Peminjaman</h2>
                        <p class="text-slate-700 text-sm">
                            Tanggal Pinjam:
                            <span class="font-medium">
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                            </span>
                        </p>
                        <p class="text-slate-700 text-sm">
                            Tanggal Kembali:
                            <span class="font-medium">
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}
                            </span>
                        </p>
                        <p class="text-slate-700 text-sm">
                            Metode Pembayaran:
                            <span class="font-medium">
                                {{ ucfirst($peminjaman->metode_pembayaran) }}
                            </span>
                        </p>
                    </div>
                </div>

                {{-- Item Table --}}
                <div>
                    <h2 class="text-lg font-semibold mb-4 text-slate-800">
                        Detail Alat
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b">
                                    <th class="p-4">Alat</th>
                                    <th class="p-4">Harga Sewa</th>
                                    <th class="p-4 text-center">Jumlah</th>
                                    <th class="p-4 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman->peminjaman_details as $detail)
                                    <tr class="border-b hover:bg-slate-50">
                                        <td class="p-4 flex items-center gap-4">
                                            <img src="{{ asset('storage/'.$detail->alat->foto_alat) }}"
                                                class="w-14 h-14 rounded-lg object-cover border">
                                            <div>
                                                <p class="font-medium text-slate-800">
                                                    {{ $detail->alat->nama_alat }}
                                                </p>
                                                <p class="text-xs text-slate-500">
                                                    Stok tersedia: {{ $detail->alat->stok }}
                                                </p>
                                            </div>
                                        </td>

                                        <td class="p-4">
                                            Rp {{ number_format($detail->alat->harga_sewa, 0, ',', '.') }}
                                        </td>

                                        <td class="p-4 text-center">
                                            {{ $detail->jumlah }}
                                        </td>

                                        <td class="p-4 text-right font-medium">
                                            Rp {{ number_format($detail->alat->harga_sewa * $detail->jumlah, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="flex justify-end">
                    <div class="w-full md:w-96 space-y-3 text-sm">

                        <div class="flex justify-between">
                            <span class="text-slate-600">Subtotal</span>
                            <span class="font-medium">
                                Rp {{ number_format($peminjaman->subtotal, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-600">Deposit</span>
                            <span class="font-medium">
                                Rp {{ number_format($peminjaman->deposit, 0, ',', '.') }}
                            </span>
                        </div>

                        @if($peminjaman->status === 'dikembalikan')
                            <div class="flex justify-between text-red-600">
                                <span>Denda</span>
                                <span class="font-medium">
                                    Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex justify-between text-slate-600">
                                <span>Total Terlambat</span>
                                <span class="font-medium">
                                    {{ $peminjaman->total_terlambat }} hari
                                </span>
                            </div>

                            <div class="flex justify-between text-slate-600">
                                <span>Dikembalikan Pada</span>
                                <span class="font-medium">
                                    {{ \Carbon\Carbon::parse($peminjaman->dikembalikan_pada)->format('d M Y') }}
                                </span>
                            </div>
                        @endif

                        <div class="border-t pt-4 flex justify-between text-base font-bold text-slate-800">
                            <span>Total</span>
                            <span>
                                Rp {{ number_format($peminjaman->total, 0, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection