@extends('layouts.app', ['dengan_sidebar' => true, 'title' => 'Riwayat Penyewaan'])

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">

    <h1 class="text-2xl font-semibold mb-6">
        Riwayat Penyewaan
    </h1>

    <div class="overflow-x-auto border rounded-lg">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-4 py-3">Produk</th>
                    <th class="text-left px-4 py-3">Tanggal</th>
                    <th class="text-left px-4 py-3">Durasi</th>
                    <th class="text-left px-4 py-3">Total</th>
                    <th class="text-left px-4 py-3">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                    <tr class="hover:bg-gray-200">
                        <td class="px-4 py-3">
                            Nama Alat
                        </td>

                        <td class="px-4 py-3">
                            20-10-2028 - 29-10-2028
                        </td>

                        <td class="px-4 py-3">
                            3 Hari
                        </td>

                        <td class="px-4 py-3">
                            Rp 100.000,00
                        </td>

                        <td class="px-4 py-3">
                            dipinjam
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            Belum ada riwayat penyewaan.
                        </td>
                    </tr>
                {{-- @endforelse --}}
            </tbody>
        </table>
    </div>

</div>
@endsection
