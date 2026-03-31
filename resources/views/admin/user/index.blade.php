@extends ('layouts.admin')
@section ('content')

<a href="{{ route('admin.dashboard') }}"
class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
← Kembali
</a>
<div class="max-w-xl mx-auto bg-white shadow-xl rounded-2xl p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Tambah User
    </h2>
    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
            {{ session('success') }}
            <script>
            document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("user-panel").scrollIntoView({
            behavior: "smooth"
        });
    });
</script>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Nama
            </label>
            <input type="text" name="name" required
                value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Email
            </label>
            <input type="email" name="email"
                value="{{ old('email') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Password
            </label>
            <input type="password" name="password"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Alamat
            </label>
            <input type="text" name="alamat"
                value="{{ old('alamat') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Role
            </label>
            <select name="role"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>
                    Petugas
                </option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                    User
                </option>
            </select>
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition duration-200">
                Simpan User
            </button>
        </div>

    </form>
</div>
@endsection