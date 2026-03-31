@if(!isset($alats))
    @php return; @endphp
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

@foreach($alats as $alat)
    <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

        <!-- Gambar -->
        <div class="h-40 bg-gray-100 flex items-center justify-center">
            @if($alat->gambar)
                <img src="{{ asset('storage/'.$alat->gambar) }}"
                     class="h-full object-cover w-full">
            @else
                <span class="text-gray-400 text-sm">No Image</span>
            @endif
        </div>

        <!-- Content -->
        <div class="p-4 space-y-2">

            <h3 class="font-semibold text-lg">
                {{ $alat->nama_alat }}
            </h3>

            <p class="text-sm text-gray-500">
                {{ $alat->kategori->nama_kategori ?? '-' }}
            </p>

            <p class="text-sm">
                Stok:
                <span class="{{ $alat->stok == 0 ? 'text-red-500 font-semibold' : 'text-green-600' }}">
                    {{ $alat->stok }}
                </span>
            </p>

            <p class="font-bold text-blue-600">
                Rp {{ number_format($alat->harga_sewa,0,',','.') }}
            </p>

            <!-- Action Buttons -->
            <div class="flex gap-2 pt-2">
                <a href="{{ route('admin.alat.edit', $alat->id) }}"
                   class="flex-1 text-center bg-yellow-400 hover:bg-yellow-500 text-white py-1 rounded-lg text-sm">
                    Edit
                </a>

                <form action="{{ route('admin.alat.destroy', $alat->id) }}"
                      method="POST"
                      class="flex-1">
                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Yakin hapus?')"
                            class="w-full bg-red-500 hover:bg-red-600 text-white py-1 rounded-lg text-sm">
                        Hapus
                    </button>
                </form>
            </div>

        </div>
    </div>
@endforeach

</div>

<div class="mt-6">
    {{ $alats->links() }}
</div>