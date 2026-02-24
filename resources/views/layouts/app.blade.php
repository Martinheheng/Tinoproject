<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Peminjaman Alat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100">

    {{-- NAVBAR --}}
    <div class="bg-gray-900 text-white px-6 py-4 flex justify-between">
        
        <div>
            <b>Sistem Peminjaman</b>
        </div>

        <div>
            @auth
                Login sebagai: {{ auth()->user()->role }}

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="ml-2 underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-4 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth
        </div>

    </div>

    {{-- CONTENT --}}
    <div class="p-6">
        @yield('content')
    </div>

</body>
</html>