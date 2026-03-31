@extends ('layouts.admin')
@section('content')

<div class="max-w-3xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Kategori</h2>

        <div class="flex gap-3">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">
                ← Dashboard
            </a>

            <!-- Kembali ke Index -->
            <a href="{{ route('admin.kategori.index') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                Lihat Data
            </a>
        </div>
    </div>

    <!-- Card Form -->
    <div class="bg-white shadow-lg rounded-xl p-6">

        <!-- Error Validation -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kategori.update', $kategori->id) }}" 
              method="POST" 
              class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium mb-2">
                    Nama Kategori
                </label>
                <input 
                    type="text" 
                    name="nama_kategori"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                    required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:outline-none"
                >
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.kategori.index') }}"
                   class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg">
                    Batal
                </a>

                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg shadow">
                    Update
                </button>
            </div>
        </form>

    </div>
</div>

@endsection