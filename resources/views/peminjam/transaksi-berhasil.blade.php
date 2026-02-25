@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <a href="{{ route('peminjam.riwayat-penyewaan') }}" class="flex items-center gap-x-2 text-lg font-semibold mb-6">
        <svg fill="#383838" class="w-5 h-5" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" stroke="#383838"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title></title><path d="M160,89.75H56l53-53a9.67,9.67,0,0,0,0-14,9.67,9.67,0,0,0-14,0l-56,56a30.18,30.18,0,0,0-8.5,18.5c0,1-.5,1.5-.5,2.5a6.34,6.34,0,0,0,.5,3,31.47,31.47,0,0,0,8.5,18.5l56,56a9.9,9.9,0,0,0,14-14l-52.5-53.5H160a10,10,0,0,0,0-20Z"></path></g></svg>
        Riwayat Penyewaan
    </a>

    {{-- HEADER SUCCESS --}}
    <div class="bg-blue-700 text-white rounded-xl py-8 text-center relative">
        <div class="flex justify-center mb-3">
            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white text-xl">
                ✓
            </div>
        </div>

        <h1 class="text-2xl font-semibold">Transaksi Berhasil</h1>
        <p class="opacity-90">ID Pesanan</p>
    </div>

    {{-- CONTENT --}}
    <div class="grid md:grid-cols-2 gap-8 mt-10">

        {{-- DETAIL TRANSAKSI --}}
        <div class="border rounded-2xl p-6">
            <h2 class="text-blue-600 font-semibold text-lg mb-4 border-b pb-2">
                Detail Transaksi
            </h2>

            <div class="space-y-4 text-sm">

                <div class="flex justify-between border-b pb-2">
                    <span>Produk :</span>
                    <span class="font-semibold text-right">
                        Carbon Telescopic Rod (Panjang 2-4 m)
                    </span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Nama Penyewa :</span>
                    <span class="font-semibold">Tino</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Telepon :</span>
                    <span class="font-semibold">085123456789</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Alamat :</span>
                    <span class="font-semibold text-right">
                        Pajaran-Gunting-kec.Sukorejo
                    </span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Tanggal Ambil :</span>
                    <span class="font-semibold">12/12/2025</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Tanggal Kembali :</span>
                    <span class="font-semibold">03/01/2026</span>
                </div>

                <div class="flex justify-between">
                    <span>Durasi :</span>
                    <span class="font-semibold">4 Hari</span>
                </div>

            </div>
        </div>

        {{-- INFORMASI PEMBAYARAN --}}
        <div class="border rounded-2xl p-6">
            <h2 class="text-blue-600 font-semibold text-lg mb-4 border-b pb-2">
                Informasi Pembayaran
            </h2>

            <div class="space-y-6">

                {{-- METODE --}}
                <div>
                    <span class="inline-block bg-blue-100 text-blue-600 text-sm px-3 py-1 rounded-full mb-3">
                        Transfer Bank (BCA)
                    </span>

                    <div class="bg-blue-100 rounded-xl p-4 text-sm space-y-1">
                        <p><strong>Nomor Rekening:</strong> 987654321</p>
                        <p><strong>Atas Nama:</strong> FishGear Rental</p>
                        <p><strong>Bank:</strong> BCA</p>
                    </div>
                </div>

                {{-- RINCIAN --}}
                <div class="bg-blue-100 rounded-xl p-4 text-sm space-y-3">
                    <div class="flex justify-between">
                        <span>Harga Sewa Satuan :</span>
                        <span>Rp.100.000</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Durasi :</span>
                        <span>4 Hari</span>
                    </div>

                    <hr class="my-3">

                    <div class="flex justify-between font-semibold text-base">
                        <span>Total Pembayaran</span>
                        <span>Rp.400.000</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection