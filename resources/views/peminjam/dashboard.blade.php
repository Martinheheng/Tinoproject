@extends('layouts.app', ['dengan_sidebar' => true, 'title' => 'Dashboard'])

@section('content')

    {{-- ================= HERO / BANNER ================= --}}
    <section class="relative bg-gray-900 text-white rounded-2xl overflow-hidden">
        <img src="https://picsum.photos/1200/400" class="w-full h-full object-cover opacity-40">
    </section>


    {{-- ================= PRODUK SECTION ================= --}}
    <section class="mt-12">

        <h2 class="text-2xl mb-6 font-semibold">
            Semua Produk
        </h2>

        @if(request('search'))
            <p class="mb-4 text-sm text-gray-600">
                Hasil pencarian untuk:
                <span class="font-semibold text-gray-800">
                    "{{ request('search') }}"
                </span>
                ({{ $alat->count() }} ditemukan)
            </p>
        @endif

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            {{-- Card 1 --}}
            @forelse ($alat as $item)
                <a href="{{ route('peminjam.detail-alat', ['id_alat' => $item->id]) }}"
                class="group bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden relative">

                    {{-- Status Badge --}}
                    @if ($item->stok > 0)
                        <span class="absolute top-3 left-3 text-xs px-2 py-1 rounded-full bg-green-100 text-green-700 font-medium">
                            Tersedia
                        </span>
                    @else
                        <span class="absolute top-3 left-3 text-xs px-2 py-1 rounded-full bg-red-100 text-red-700 font-medium">
                            Habis
                        </span>
                    @endif

                    {{-- Stok Menipis --}}
                    @if ($item->stok > 0 && $item->stok <= 3)
                        <span class="absolute top-3 right-3 text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-700 font-medium">
                            Stok Menipis
                        </span>
                    @endif

                    <div class="aspect-square overflow-hidden">
                        <img src="{{ $item->foto_alat }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>

                    <div class="p-4">
                        <h3 class="font-medium text-gray-800 group-hover:text-black transition">
                            {{ $item->nama_alat }}
                        </h3>

                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <p class="text-xs text-gray-600 border border-gray-300 px-2 py-1 rounded">
                                Stok: <b>{{ $item->stok }}</b>
                            </p>

                            <p class="text-xs text-gray-600 border border-gray-300 px-2 py-1 rounded">
                                Kondisi: <b>Baru</b>
                            </p>
                        </div>

                        <div class="mt-3 flex items-center justify-between">
                            <span class="font-semibold text-gray-900">
                                Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </a>

            @empty
                <div class="col-span-full text-center py-16 text-gray-500">
                    <p class="text-lg font-medium">Produk tidak ditemukan</p>
                    <p class="text-sm mt-2">Coba gunakan kata kunci lain.</p>
                </div>
            @endforelse

        </div>
    </section>
@endsection
