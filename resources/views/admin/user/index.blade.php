@if($errors->any())
    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700 border border-red-300">
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.user.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Nama" required
        class="border p-2 w-full mb-3">

    <input type="email" name="email" placeholder="Email"
        class="border p-2 w-full mb-3">

    <input type="password" name="password" placeholder="Password"
        class="border p-2 w-full mb-3">

    <input type="text" name="alamat" 
    placeholder="Alamat"
    class="border p-2 w-full mb-3">

    <select name="role" class="border p-2 w-full mb-3">
        <option value="admin">Admin</option>
        <option value="petugas">Petugas</option>
        <option value="user">User</option>
    </select>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>
@if(session('success'))
    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700 border border-green-300">
        {{ session('success') }}
    </div>
@endif