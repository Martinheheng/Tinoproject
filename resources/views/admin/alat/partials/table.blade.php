<table class="min-w-full text-sm text-left border border-gray-200 rounded-lg overflow-hidden">

    <thead class="bg-gray-100 text-gray-600 text-xs">
        <tr>
            <th class="px-4 py-3 text-center">
                <input type="checkbox" id="checkAll">
            </th>
            <th class="px-6 py-3">Nama</th>
            <th class="px-6 py-3">Kategori</th>
            <th class="px-6 py-3 text-center">Stok</th>
            <th class="px-6 py-3 text-right">Harga</th>
        </tr>
    </thead>

    <tbody>
        @foreach($alats as $alat)
        <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 text-center">
                <input type="checkbox" name="ids[]" value="{{ $alat->id }}" class="rowCheckbox">
            </td>
            <td class="px-6 py-3">{{ $alat->nama_alat }}</td>
            <td class="px-6 py-3">{{ $alat->kategori->nama_kategori ?? '-' }}</td>
            <td class="px-6 py-3 text-center">{{ $alat->stok }}</td>
            <td class="px-6 py-3 text-right">Rp {{ number_format($alat->harga_sewa) }}</td>
        </tr>
        @endforeach
    </tbody>

</table>