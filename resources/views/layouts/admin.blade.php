<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white min-h-screen p-5">

        <h1 class="text-2xl font-bold mb-8">⚡ Admin</h1>

        <nav class="space-y-2 text-sm">

            <a href="/admin/dashboard" class="block p-2 rounded hover:bg-slate-700">
                Dashboard
            </a>

            <a href="{{ route('admin.user.index') }}" class="block p-2 rounded hover:bg-slate-700">
                User
            </a>

            <a href="{{ route('admin.alat.index') }}" class="block p-2 rounded hover:bg-slate-700">
                Alat
            </a>

            <a href="{{ route('admin.kategori.index') }}" class="block p-2 rounded hover:bg-slate-700">
                Kategori
            </a>
            <a href="{{ route('admin.log.index') }}" class="block p-2 rounded hover:bg-slate-700">
                Log Aktifitas
            </a>
          

        </nav>

    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

        <!-- NAVBAR -->
        <header class="bg-white shadow p-4 flex justify-between items-center">

            <h2 class="font-semibold text-lg">
                @yield('title')
            </h2>

            <div>
                <span class="text-gray-600 mr-4">Admin</span>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                        Logout
                    </button>
                </form>
            </div>

        </header>

        <!-- CONTENT -->
        <main class="p-6">

            <!-- ALERT -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ERROR -->
            @if($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- SLOT CONTENT -->
            <div class="bg-white p-6 rounded shadow">
                @yield('content')
            </div>

        </main>

    </div>

</div>

</body>
</html>