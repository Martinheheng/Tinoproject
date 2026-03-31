@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- 📊 STATISTIK -->
    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white p-5 rounded-2xl shadow">
            <p class="text-sm text-gray-500">Total Alat</p>
            <p class="text-2xl font-bold">{{ $totalAlat }}</p>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow">
            <p class="text-sm text-gray-500">Total Stok</p>
            <p class="text-2xl font-bold">{{ $totalStok }}</p>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow">
            <p class="text-sm text-gray-500">Stok Habis</p>
            <p class="text-2xl font-bold text-red-500">{{ $alatHabis }}</p>
        </div>
    </div>

    <!-- HEADER -->
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold">Manajemen Alat</h2>

        <a href="{{ route('admin.alat.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl shadow text-sm">
            + Tambah Alat
        </a>
    </div>

    <!-- FILTER -->
    <div class="bg-white p-6 rounded-2xl shadow">
        <form id="filterForm" class="flex flex-wrap gap-4">

            <input type="text" name="search"
                value="{{ request('search') }}"
                placeholder="Search alat..."
                class="border rounded-lg px-4 py-2 text-sm">

            <select name="kategori"
                class="border rounded-lg px-4 py-2 text-sm">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                Filter
            </button>
        </form>
    </div>

    <!-- 🔥 BULK DELETE FORM -->
    <form action="{{ route('admin.alats.bulkDelete') }}" method="POST">
        @csrf

        <div id="dataContainer">
            @isset($alats)
                @include('admin.alat.partials.table')
            @endisset
        </div>

        <div class="mt-4 flex justify-end">
            <button type="submit"
                onclick="return confirm('Yakin mau hapus data yang dipilih?')"
                class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl shadow">
                Bulk Delete
            </button>
        </div>
    </form>

</div>

<script>
function attachCheckboxEvent() {
    const checkAll = document.getElementById('checkAll');
    const checkboxes = document.querySelectorAll('.rowCheckbox');

    if (checkAll) {
        checkAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    attachCheckboxEvent();

    document.querySelector('[name="search"]').addEventListener('keyup', fetchData);
    document.querySelector('[name="kategori"]').addEventListener('change', fetchData);
});

function fetchData() {
    let form = document.getElementById('filterForm');
    let params = new URLSearchParams(new FormData(form));

    fetch("{{ route('admin.alat.index') }}?" + params)
        .then(res => res.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');

            document.getElementById('dataContainer').innerHTML =
                doc.getElementById('dataContainer').innerHTML;

            attachCheckboxEvent(); // 🔥 penting
        });
}
</script>

@endsection