@extends('layouts.app', ['title' => 'Proses Penyewaan Alat'])
@section('content')
    <div class="min-h-screen bg-gray-50 p-6">
        <form method="post" action="{{ route('peminjam.proses-penyewaan.store') }}" class="max-w-7xl mx-auto grid lg:grid-cols-3 gap-6">
            @csrf
            <input type="hidden" name="alat_id" value="{{ $alat->id }}">
            <input type="hidden" name="jumlah_alat" value="{{ $alat->qty }}">

            {{-- ================= LEFT SIDE ================= --}}
            <div class="lg:col-span-3 space-y-6">
                <a href="/" class="flex items-center gap-x-2 text-lg font-semibold">
                    <svg fill="#383838" class="w-5 h-5" viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" stroke="#383838"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title></title><path d="M160,89.75H56l53-53a9.67,9.67,0,0,0,0-14,9.67,9.67,0,0,0-14,0l-56,56a30.18,30.18,0,0,0-8.5,18.5c0,1-.5,1.5-.5,2.5a6.34,6.34,0,0,0,.5,3,31.47,31.47,0,0,0,8.5,18.5l56,56a9.9,9.9,0,0,0,14-14l-52.5-53.5H160a10,10,0,0,0,0-20Z"></path></g></svg>
                    Proses Penyewaan
                </a>

                <div class="bg-white rounded-xl shadow p-6 h-fit space-y-6">

                    <div class="flex gap-4">
                        <img src="{{ Storage::url($alat->foto_alat) }}"
                            class="rounded-lg w-24 h-24 object-cover">

                        <div>
                            <h3 class="font-semibold">
                                {{ $alat->nama_alat }} x {{ $alat->qty }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                <span id="total_hari"></span> hari x Rp {{ number_format($alat->total_sewa, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Harga Sewa</span>
                            <input type="number" name="subtotal_harga_sewa" id="total_harga_sewa_input" hidden>
                            <span>Rp <span id="total_harga_sewa"></span></span>
                        </div>
                        <div class="flex justify-between">
                            <input type="number" name="deposit" id="deposit_input" hidden>
                            <span>Deposit (50%)</span>
                            <span>Rp <span id="deposit"></span></span>
                        </div>
                        <hr>
                        <div class="flex justify-between font-semibold text-red-500">
                            <span>Total</span>
                            <input type="number" name="total" id="total_input" hidden>
                            <span>Rp <span id="total"></span></span>
                        </div>
                    </div>

                </div>


                {{-- 2 & 3 GRID --}}
                <div class="grid md:grid-cols-2 gap-6">

                    {{-- METODE PEMBAYARAN --}}
                    <div class="bg-white border-l-6 border-blue-500 rounded-xl shadow p-6 space-y-4">
                        <h2 class="font-semibold text-lg">2. Metode Pembayaran</h2>

                        <div class="space-y-3">

                            <label class="block cursor-pointer">
                                <input type="radio" name="payment_method" value="bca" class="peer hidden">
                                <div class="w-full border rounded-lg py-2 px-3
                                            text-gray-700
                                            hover:bg-gray-50
                                            peer-checked:border-blue-600
                                            peer-checked:bg-blue-50
                                            peer-checked:text-blue-600
                                            transition">
                                    Transfer Bank (BCA)
                                </div>
                            </label>

                            <label class="block cursor-pointer">
                                <input type="radio" name="payment_method" value="card" class="peer hidden">
                                <div class="w-full border rounded-lg py-2 px-3
                                            text-gray-700
                                            hover:bg-gray-50
                                            peer-checked:border-blue-600
                                            peer-checked:bg-blue-50
                                            peer-checked:text-blue-600
                                            transition">
                                    Kartu Kredit/Debit
                                </div>
                            </label>

                            <label class="block cursor-pointer">
                                <input type="radio" name="payment_method" value="cod" class="peer hidden">
                                <div class="w-full border rounded-lg py-2 px-3
                                            text-gray-700
                                            hover:bg-gray-50
                                            peer-checked:border-blue-600
                                            peer-checked:bg-blue-50
                                            peer-checked:text-blue-600
                                            transition">
                                    Bayar di Tempat (COD)
                                </div>
                            </label>

                        </div>
                    </div>


                    {{-- JADWAL SEWA --}}
                    <div class="bg-white border-l-6 border-blue-500 rounded-xl shadow p-6 space-y-4">
                        <h2 class="font-semibold text-lg">3. Jadwal Sewa</h2>

                        <div>
                            <label class="text-sm font-medium">Tanggal Ambil</label>
                            <input type="date"
                                name="tanggal_pinjam"
                                id="tanggal_pinjam"
                                class="w-full mt-1 rounded-lg border-gray-300 border px-2 py-1">
                        </div>

                        <div>
                            <label class="text-sm font-medium">Tanggal Kembali</label>
                            <input type="date"
                                name="tanggal_kembali"
                                id="tanggal_kembali"
                                class="w-full mt-1 rounded-lg border-gray-300 border px-2 py-1">
                        </div>

                        <div class="bg-blue-50 text-blue-600 text-sm p-3 rounded-lg">
                            <input type="text" id="total_hari_input" name="total_hari" value="0" hidden></span>
                            Total Durasi: <span id="total_hari"></span> Hari
                        </div>
                    </div>

                </div>


                {{-- INFO SECTION --}}
                <div class="flex flex-col bg-white rounded-xl shadow p-6 gap-6 text-sm">
                    <p class="font-semibold text-red-500">Penting!</p>
                    <div class="flex items-center flex-wrap gap-y-6 justify-between w-full">
                        <div class="space-y-2">
                            <ul class="space-y-1 list-disc pl-4">
                                <li>Keterlambatan dikenakan denda Rp50.000/hari</li>
                                <li>Kerusakan alat dibebankan ke penyewa</li>
                                <li>Deposit hangus jika alat hilang</li>
                            </ul>
                        </div>

                        <div class="space-y-2">
                            <p><strong>Durasi fleksibel</strong> (min 1 hari, max 30 hari)</p>
                            <p><strong>Deposit 50%</strong> dari harga sewa</p>
                            <p><strong>Penalty</strong> Rp50.000/hari</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full px-3 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                    Konfirmasi Pembayaran
                </button>

            </div>


            {{-- ================= RIGHT SIDE ================= --}}


        </form>
    </div>

@endsection

@section('script')
    <script>
        const tglAmbil = document.getElementById('tanggal_pinjam');
        const tglKembali = document.getElementById('tanggal_kembali');

        const totalHargaSewa = document.getElementById('total_harga_sewa');

        const deposit = document.getElementById('deposit');

        const totalElements = document.getElementById('total');

        const totalHariElements = document.querySelectorAll('#total_hari');
        const totalHariInput = document.getElementById('total_hari_input');

        function updateTotalHari(value) {
            totalHariInput.value = value
            totalHariElements.forEach(el => {
                el.innerText = value;
            });
        }

        function format_rupiah(value) {
            parseInt(value)
            return value.toLocaleString('id-ID');
        }

        // default 0
        updateTotalHari(0)

        // 1️⃣ set default tanggal ambil = hari ini
        const today = new Date().toISOString().split('T')[0];
        tglAmbil.value = today;

        // 2️⃣ hitung selisih hari
        function hitungHari() {
            if (!tglAmbil.value || !tglKembali.value) {
                updateTotalHari(0)
                return;
            }

            const ambil = new Date(tglAmbil.value);
            const kembali = new Date(tglKembali.value);

            const selisihMs = kembali - ambil;
            const selisihHari = selisihMs / (1000 * 60 * 60 * 24);

            if (selisihHari > 0) {
                updateTotalHari(selisihHari)

                let subtotal = selisihHari * {{ (int) $alat->total_sewa }}

                totalHargaSewa.innerText = format_rupiah(subtotal)

                deposit.innerText = format_rupiah(subtotal * 0.5)

                let total = subtotal + (subtotal * 0.5)
                totalElements.innerText = format_rupiah(total)
            } else {
                updateTotalHari(0)
                totalHargaSewa.innerText = format_rupiah(0)

                deposit.innerText = format_rupiah(0)
            }
        }

        tglKembali.addEventListener('change', hitungHari);
        tglAmbil.addEventListener('change', hitungHari);
    </script>
@endsection
