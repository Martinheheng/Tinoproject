@extends('layouts.app', ['dengan_sidebar' => true],['title' => 'Detail Alat'])

@section('content')
    @php
        $qty = 1;
    @endphp

    <div class="max-w-7xl mx-auto">

        <a href="{{ route('peminjam.dashboard') }}" class="flex items-center gap-x-2 text-lg font-semibold mb-6">
            <svg fill="#383838" class="w-5 h-5" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1"
                xmlns="http://www.w3.org/2000/svg" stroke="#383838">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <title></title>
                    <path
                        d="M160,89.75H56l53-53a9.67,9.67,0,0,0,0-14,9.67,9.67,0,0,0-14,0l-56,56a30.18,30.18,0,0,0-8.5,18.5c0,1-.5,1.5-.5,2.5a6.34,6.34,0,0,0,.5,3,31.47,31.47,0,0,0,8.5,18.5l56,56a9.9,9.9,0,0,0,14-14l-52.5-53.5H160a10,10,0,0,0,0-20Z">
                    </path>
                </g>
            </svg>
            Proses Penyewaan
        </a>
        <div class="grid lg:grid-cols-12 gap-8">
            {{-- ================= LEFT : IMAGE GALLERY ================= --}}
            <div class="lg:col-span-4">

                <div class="bg-white rounded-xl shadow p-4">
                    <img src="{{ Storage::url($alat->foto_alat) }}" class="w-full rounded-lg object-cover">
                </div>

            </div>


            {{-- ================= CENTER : PRODUCT INFO ================= --}}
            <div class="lg:col-span-5 space-y-4">

                <h1 class="text-3xl font-bold text-gray-800">
                    {{ $alat->nama_alat }}
                </h1>

                <div class="text-3xl font-semibold text-gray-900">
                    Rp. {{ number_format($alat->harga_sewa, 0, ',', '.') }}
                </div>

                <hr>

                <p class="text-gray-600 leading-relaxed">
                    {{ $alat->deskripsi }}
                </p>

                {{-- Seller --}}
                <div class="flex items-center gap-3 pt-4 border-t">
                    <img src="https://picsum.photos/100" class="w-12 h-12 rounded-full object-cover">

                    <div>
                        <div class="bg-white rounded-xl shadow-2">

                        </div>
                        <div class="font-semibold text-gray-800">
                            Admin FISH GEAR
                        </div>
                        <div class="text-sm text-gray-500">
                            Penjual Terverifikasi
                        </div>
                    </div>
                </div>

            </div>


            {{-- ================= RIGHT : PURCHASE CARD ================= --}}
            <div class="lg:col-span-3">

                <div class="bg-white rounded-xl shadow p-6 space-y-4 lg:sticky lg:top-24">

                    <h2 class="font-semibold text-lg">
                        Atur jumlah dan catatan
                    </h2>

                    {{-- Quantity --}}
                    <div class="flex items-center gap-4">
                        <div class="flex items-center border rounded-lg overflow-hidden w-fit">
                            <button type="button" id="minus" class="px-4 py-2 bg-gray-100 hover:bg-gray-200">
                                −
                            </button>

                            <input type="number" id="qty" value="1" min="1"
                                class="w-16 text-center outline-none">

                            <button type="button" id="plus" class="px-4 py-2 bg-gray-100 hover:bg-gray-200">
                                +
                            </button>
                        </div>

                        <span class="text-sm text-gray-500">
                            Stok : {{ $alat->stok }}
                        </span>
                    </div>

                    <div class="text-2xl font-bold text-gray-900">
                        Rp. <span id="total_harga">{{ number_format($alat->harga_sewa, 0, ',', '.') }}</span>
                    </div>

                    {{-- Buttons --}}
                    <div class="space-y-3">

                        <form method="post" action="{{ route('peminjam.keranjang.add') }}">
                            @csrf
                            <input type="hidden" name="alat_id" value="{{ $alat->id }}">
                            <input type="hidden" name="jumlah" id="jumlah_alat" value="1">

                            <button type="submit"
                                class="block w-full text-center bg-gray-200 hover:bg-gray-300 transition py-3 rounded-lg font-medium">
                                Masukkan Keranjang
                            </button>
                        </form>

                        <form action="{{ route('peminjam.proses-penyewaan', ['id_alat' => $alat->id]) }}" method="get">
                            <input type="number" name="qty" id="qty_hidden" value="1" hidden>

                            <button type="submit"
                                class="block w-full text-center bg-teal-500 hover:bg-teal-600 text-white transition py-3 rounded-lg font-medium shadow">
                                Sewa Sekarang
                                </a>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

@section('script')
    <script>
        const minus = document.getElementById('minus');
        const plus = document.getElementById('plus');
        const qty = document.getElementById('qty');
        const qty_hidden = document.getElementById('qty_hidden');
        const hiddenInput = document.getElementById('jumlah_alat');

        const total_harga = document.getElementById('total_harga');

        const harga_sewa = {{ (int) $alat->harga_sewa }};

        minus.addEventListener('click', () => {
            if (qty.value > 1) {
                qty.value--;
                qty_hidden.value = qty.value;
                hiddenInput.value = qty.value;
            }
            const jumlah = parseInt(qty.value) || 0;
            const total = jumlah * harga_sewa;

            total_harga.innerHTML = total.toLocaleString('id-ID');
        });

        plus.addEventListener('click', () => {
            qty.value++;

            if (qty.value > {{ $alat->stok }}) {
                qty.value = {{ $alat->stok }};
            }

            qty_hidden.value = qty.value;
            hiddenInput.value = qty.value;
            const jumlah = parseInt(qty.value) || 0;
            const total = jumlah * harga_sewa;

            total_harga.innerHTML = total.toLocaleString('id-ID');
        });

        qty.addEventListener('change', () => {})
    </script>

@endsection
