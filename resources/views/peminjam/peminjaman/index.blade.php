@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <h2 class="text-3xl font-bold text-gray-800 mb-8">
        Daftar Alat
    </h2>

    <!-- FILTER -->
    <div class="bg-white p-4 rounded-xl shadow mb-8">
        <form method="GET" class="flex flex-wrap gap-4 items-center">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari alat..."
                   class="border rounded-lg px-4 py-2 w-64">

            <select name="kategori"
                    class="border rounded-lg px-4 py-2">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Filter
            </button>
        </form>
    </div>

    <!-- CARD -->
    <div class="grid grid-cols-4 gap-6">

        @forelse($alats as $alat)

            @php
                $pinjam = $alat->peminjamans->first();
            @endphp

            @if($pinjam)
            <a href="{{ route('peminjam.peminjaman.show', $pinjam->id) }}"
            class="block bg-white rounded-2xl shadow hover:shadow-lg transition p-5 flex flex-col">
            @else
            <div class="bg-white rounded-2xl shadow p-5 flex flex-col">
            @endif

                <!-- INFO -->
                <div class="flex-1">

                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $alat->nama }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $alat->kategori->nama_kategori ?? '-' }}
                    </p>

                    <!-- STATUS -->
                    <div class="mt-3">
                        @if($pinjam)
                            <span class="bg-blue-100 text-blue-600 text-xs px-3 py-1 rounded-full">
                                {{ ucfirst($pinjam->status) }}
                            </span>
                        @elseif($alat->stok > 0)
                            <span class="bg-green-100 text-green-600 text-xs px-3 py-1 rounded-full">
                                Tersedia
                            </span>
                        @else
                            <span class="bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full">
                                Stok Habis
                            </span>
                        @endif
                    </div>

                    <!-- DETAIL PEMINJAMAN -->
                    @if($pinjam)
                        <div class="mt-3 text-xs text-gray-500 space-y-1">
                            <p>Pinjam: {{ $pinjam->tanggal_pinjam }}</p>
                            <p>Kembali: {{ $pinjam->tanggal_kembali_rencana }}</p>
                        </div>
                    @endif

            @if($pinjam)
            </a>
            @else
            </div>
            @endif

                <!-- BUTTON -->
                <div class="mt-6">

                    @if(!$pinjam && $alat->stok > 0)
                        <a href="{{ route('peminjam.peminjaman.create', $alat->id) }}"
                           class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm">
                            Pinjam Sekarang
                        </a>
                    @else
                        <button disabled
                                class="w-full bg-gray-300 text-gray-500 py-2 rounded-lg text-sm">
                            @if($pinjam)
                                Sedang Dipinjam
                            @else
                                Tidak Tersedia
                            @endif
                        </button>
                    @endif

                </div>

            </div>

        @empty
            <p class="col-span-4 text-center text-gray-400">
                Tidak ada alat ditemukan.
            </p>
        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="mt-10">
        {{ $alats->links() }}
    </div>

</div>

@endsection