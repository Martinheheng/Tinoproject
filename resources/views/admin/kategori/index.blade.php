@extends ('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Kategori</h2>

        <div class="flex gap-3">
            <!-- Tombol Kembali -->
            <a href="{{ route('admin.dashboard') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                ← Dashboard
            </a>

            <!-- Tombol Tambah -->
            <a href="{{ route('admin.kategori.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                + Tambah
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <form method="GET" class="mb-4">
    <div class="flex gap-2">
        <input type="text"
               name="search"
               placeholder="Cari kategori..."
               value="{{ request('search') }}"
               class="border rounded-lg px-4 py-2 w-64">

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Search
        </button>
    </div>
</form>
    <!-- Card Table -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Kategori</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($kategoris as $kategori)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-gray-700">
                        {{ $kategori->nama_kategori }}
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
    <div class="mt-4">
    {{ $kategoris->links() }}
    </div>
                        <!-- Edit -->
                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                            Edit
                        </a>

                        <!-- Hapus -->
                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Yakin mau hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center py-6 text-gray-500">
                        Belum ada data kategori.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection