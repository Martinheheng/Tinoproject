@extends('layouts.app', ['title' => 'Keranjang'])

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">

    <h1 class="text-2xl font-semibold mb-6">
        Keranjang
    </h1>

    <form action="#" method="POST">
        @csrf

        <div class="overflow-x-auto border rounded-lg">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3"></th>
                        <th class="text-left px-4 py-3">Produk</th>
                        <th class="text-left px-4 py-3">Harga</th>
                        <th class="text-left px-4 py-3">Durasi</th>
                        <th class="text-left px-4 py-3">Subtotal</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    {{-- @forelse($cartItems as $item) --}}
                        <tr>
                            <td class="px-4 py-3">
                                <input type="checkbox"
                                       name="selected_items[]"
                                       value="id"
                                       class="w-4 h-4">
                            </td>

                            <td class="px-4 py-3">
                                Produk
                            </td>

                            <td class="px-4 py-3">
                                Rp 100.000
                            </td>

                            <td class="px-4 py-3">
                                12 Hari
                            </td>

                            <td class="px-4 py-3">
                                Rp 1.200.000
                            </td>
                        </tr>
                    {{-- @empty --}}
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Keranjang kosong.
                            </td>
                        </tr>
                    {{-- @endforelse --}}
                </tbody>
            </table>
        </div>

        {{-- @if($cartItems->count()) --}}
            <div class="mt-6 text-right">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Checkout
                </button>
            </div>
        {{-- @endif --}}

    </form>

</div>
@endsection