<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white p-6 space-y-6 flex-shrink-0">

        <h2 class="text-2xl font-bold text-emerald-400">Fish Gear</h2>

        <nav class="space-y-2 text-sm">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">
                Dashboard
            </a>

            <p class="text-gray-400 text-xs mt-4">MASTER DATA</p>

            <a href="{{ route('admin.user.index') }}"
               class="block px-4 py-2 rounded {{ request()->routeIs('admin.user.*') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">
                User
            </a>

            <a href="{{ route('admin.kategori.index') }}"
               class="block px-4 py-2 rounded {{ request()->routeIs('admin.kategori.*') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">
                Kategori
            </a>

            <a href="{{ route('admin.alat.index') }}"
               class="block px-4 py-2 rounded {{ request()->routeIs('admin.alat.*') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">
                Alat
            </a>

            <p class="text-gray-400 text-xs mt-4">TRANSAKSI</p>

            <a href="{{ route('admin.peminjaman.index') }}"
               class="block px-4 py-2 rounded hover:bg-slate-700">
                Peminjaman
            </a>

            <a href="{{ route('admin.pengembalian.index') }}"
               class="block px-4 py-2 rounded hover:bg-slate-700">
                Pengembalian
            </a>

            <p class="text-gray-400 text-xs mt-4">SYSTEM</p>

            <a href="{{ route('admin.log.index') }}"
               class="block px-4 py-2 rounded hover:bg-slate-700">
                Log Aktivitas
            </a>

        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 overflow-y-auto p-8">

        <!-- HEADER -->
         
                @php
                $routeName = request()->route()->getName();

                if ($routeName == 'admin.dashboard') {
                $pageTitle = 'Dashboard';
                } else {
                    $segments = explode('.', $routeName);
                    $pageTitle = ucfirst($segments[1] ?? 'Dashboard');
                    }
                @endphp
                
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
              {{ $pageTitle }}
            </h1>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        </div>

        <!-- CONTENT -->
        <div class="animate-fadeIn">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>