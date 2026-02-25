@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-white p-6">
        <h2 class="text-2xl font-bold mb-8 text-emerald-400">Fish Gear Admin</h2>

        <nav class="space-y-4">
            <a href="#" class="block py-2 px-4 rounded hover:bg-slate-700">Dashboard</a>
            <a href="#kategori" class="block py-2 px-4 rounded hover:bg-slate-700">Kategori</a>
            <a href="#alat" class="block py-2 px-4 rounded hover:bg-slate-700">Alat</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <button class="bg-emerald-500 text-white px-4 py-2 rounded-lg shadow hover:bg-emerald-600">
                Logout
            </button>
        </div>

        <!-- ===================== KATEGORI ===================== -->
        <section id="kategori" class="mb-12">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Manajemen Kategori</h2>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    + Create Kategori
                </button>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-4">No</th>
                            <th class="p-4">Nama Kategori</th>
                            <th class="p-4">Deskripsi</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="p-4">1</td>
                            <td class="p-4 font-medium">Joran</td>
                            <td class="p-4">Berbagai jenis joran pancing</td>
                            <td class="p-4 text-center space-x-2">
                                <button class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500">Edit</button>
                                <button class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">Delete</button>
                            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="p-4">2</td>
                            <td class="p-4 font-medium">Reel</td>
                            <td class="p-4">Mesin pancing berbagai ukuran</td>
                            <td class="p-4 text-center space-x-2">
                                <button class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500">Edit</button>
                                <button class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ===================== ALAT ===================== -->
        <section id="alat">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-700">Manajemen Alat</h2>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    + Create Alat
                </button>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-4">No</th>
                            <th class="p-4">Nama Alat</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Harga / Hari</th>
                            <th class="p-4">Stok</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="p-4">1</td>
                            <td class="p-4 font-medium">Joran Shimano FX</td>
                            <td class="p-4">Joran</td>
                            <td class="p-4">Rp 25.000</td>
                            <td class="p-4">10</td>
                            <td class="p-4 text-center space-x-2">
                                <button class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500">Edit</button>
                                <button class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">Delete</button>
                            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="p-4">2</td>
                            <td class="p-4 font-medium">Reel Daiwa 3000</td>
                            <td class="p-4">Reel</td>
                            <td class="p-4">Rp 30.000</td>
                            <td class="p-4">5</td>
                            <td class="p-4 text-center space-x-2">
                                <button class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500">Edit</button>
                                <button class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>
</div>
@endsection
