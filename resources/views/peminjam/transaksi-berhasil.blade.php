@extends('layouts.app', ['title' => 'Transaksi Berhasil', 'dengan_sidebar' => true])

@section('content')
<div class="max-w-6xl mx-auto">

    <a href="{{ route('peminjam.riwayat-penyewaan') }}"
        class="inline-flex items-center gap-2 text-slate-600 hover:text-blue-600 mb-8">
        ← Kembali ke Riwayat
    </a>

    {{-- SUCCESS HEADER --}}
    <div class="bg-linear-to-r from-blue-600 to-indigo-600 text-white rounded-2xl p-8 text-center shadow-lg">
        <div class="w-12 h-12 bg-green-500 rounded-full mx-auto flex items-center justify-center text-xl font-bold">
            ✓
        </div>
        <h1 class="text-2xl font-semibold mt-4">Transaksi Berhasil</h1>
        <p class="opacity-90 text-sm mt-1">ID #{{ $peminjaman->id_peminjaman }}</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-8 mt-10">

        {{-- LEFT: DETAIL --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow border p-6">

            <h2 class="text-lg font-semibold text-slate-800 mb-6">
                Detail Peminjaman
            </h2>

            {{-- USER --}}
            <div class="grid md:grid-cols-2 gap-6 text-sm mb-8">
                <div>
                    <p class="font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-slate-500">{{ auth()->user()->telepon }}</p>
                    <p class="text-slate-500">{{ auth()->user()->alamat }}</p>
                </div>

                <div class="md:text-right">
                    <p>
                        <span class="text-slate-500">Tanggal Pinjam:</span><br>
                        <strong>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</strong>
                    </p>
                    <p class="mt-2">
                        <span class="text-slate-500">Tanggal Kembali:</span><br>
                        <strong>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d M Y') }}</strong>
                    </p>
                    <p class="mt-2">
                        <span class="text-slate-500">Jumlah Hari:</span><br>
                        <strong>{{ $peminjaman->jumlah_hari }}</strong>
                    </p>
                </div>
            </div>

            {{-- ITEMS --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b text-left bg-slate-50">
                            <th class="p-3">Alat</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3 text-center">Qty</th>
                            <th class="p-3 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjaman->peminjaman_details as $detail)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="p-3 font-medium">
                                {{ $detail->alat->nama_alat }}
                            </td>

                            <td class="p-3">
                                Rp {{ number_format($detail->alat->harga_sewa,0,',','.') }}
                            </td>

                            <td class="p-3 text-center">
                                {{ $detail->jumlah }}
                            </td>

                            <td class="p-3 text-right font-semibold">
                                Rp {{ number_format($detail->alat->harga_sewa * $detail->jumlah,0,',','.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- RIGHT: PAYMENT SUMMARY --}}
        <div class="bg-white rounded-2xl shadow border p-6 h-fit">

            <h2 class="text-lg font-semibold text-slate-800 mb-6">
                Ringkasan Pembayaran
            </h2>

            <div class="space-y-4 text-sm">

                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($peminjaman->subtotal,0,',','.') }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Deposit (50%)</span>
                    <span>Rp {{ number_format($peminjaman->deposit,0,',','.') }}</span>
                </div>

                <div class="border-t pt-4 flex justify-between font-bold text-base">
                    <span>Total</span>
                    <span>Rp {{ number_format($peminjaman->total,0,',','.') }}</span>
                </div>

                <div class="mt-6">
                    <span class="text-xs text-slate-500">Metode Pembayaran</span>
                    <div class="mt-2 bg-blue-100 text-blue-700 px-3 py-2 rounded-lg text-sm">
                        {{ ucfirst($peminjaman->metode_pembayaran) }}
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection