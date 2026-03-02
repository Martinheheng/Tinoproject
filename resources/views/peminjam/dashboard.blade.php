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

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            {{-- Card 1 --}}
            @foreach ($alat as $item)
                <a href="{{ route('peminjam.detail-alat', ['id_alat' => $item->id]) }}" class="group bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="aspect-square overflow-hidden">
                        <img src="{{ $item->foto_alat }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>

                    <div class="p-4">
                        <h3 class="font-medium text-gray-800 group-hover:text-black transition">
                            {{ $item->nama_alat }}
                        </h3>
                        <div class="flex items-center gap-x-3">
                            <p class="text-sm text-gray-500 mt-1 border border-gray-300 px-2 py-1 rounded-sm max-w-fit">
                                Stok : <b>{{ $item->stok }}</b>
                            </p>
                            <p class="text-sm text-gray-500 mt-1 border border-gray-300 px-2 py-1 rounded-sm max-w-fit">
                                Kondisi : <b>Baru</b>
                            </p>
                        </div>

                        <div class="mt-3 flex items-center justify-between">
                            <span class="font-semibold text-gray-900">
                                Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}
                            </span>

                        
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </section>
@endsection
