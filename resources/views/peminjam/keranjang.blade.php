@extends('layouts.app', ['dengan_sidebar' => true], ['title' => 'Keranjang'])

@section('content')
    <div class="max-w-5xl mx-auto p-6 space-y-6">

        <h1 class="text-2xl font-semibold">Keranjang</h1>

        <form method="POST" action="{{ route('peminjam.keranjang.checkout') }}">
            @csrf

            <div class="space-y-4">

                @foreach ($keranjang->keranjang_items as $item)
                    <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">

                        <div>
                            <h2 class="font-semibold">{{ $item->alat->nama_alat }}</h2>
                            <p class="text-sm text-gray-500">
                                Rp {{ number_format($item->alat->harga_sewa, 0, ',', '.') }} / hari
                            </p>
                        </div>

                        <div class="flex items-center gap-3">

                            <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1"
                                class="w-20 border rounded px-2 py-1">

                            <a href="{{ route('peminjam.keranjang.remove', $item->id) }}" class="text-red-500 text-sm">
                                Hapus
                            </a>
                        </div>

                    </div>
                @endforeach

            </div>

            <div class="grid md:grid-cols-2 gap-4 mt-6">

                <div>
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="w-full border rounded px-2 py-1">
                </div>

                <div>
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="w-full border rounded px-2 py-1">
                </div>

            </div>

            <div class="mt-4 space-y-2">
                <label class="block">
                    <input type="radio" name="metode_pembayaran" value="bca"> Transfer BCA
                </label>
                <label class="block">
                    <input type="radio" name="metode_pembayaran" value="card"> Kartu Kredit
                </label>
                <label class="block">
                    <input type="radio" name="metode_pembayaran" value="cod"> COD
                </label>
            </div>

            <button type="submit" class="w-full mt-6 bg-blue-600 text-white py-3 rounded-xl">
                Checkout
            </button>

        </form>

    </div>
@endsection
