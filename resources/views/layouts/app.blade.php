<!DOCTYPE html>
<html>

<head>
    <title>{{ $title ?? 'FishGear' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gray-100">

    {{-- NAVBAR --}}
    <div class="fixed top-0 left-64 w-[calc(100%-16rem)] z-30 bg-white/80 backdrop-blur-md border-b border-gray-200 shadow-sm">
        <div class=" mx-auto px-6 py-3 flex items-center justify-between">
            {{-- Search Bar --}}
            <form action="{{ route('peminjam.dashboard') }}" method="GET">
                <div class="hidden md:flex flex-1 max-w-xl mx-8">
                    <div class="w-full flex items-center bg-gray-100 rounded-full px-4 focus-within:ring-2 focus-within:ring-indigo-500 transition">
                        <input type="text" name="search" class="w-full bg-transparent px-3 py-2 focus:outline-none text-gray-800 text-sm" placeholder="Cari peralatan...">

                        <button class="text-gray-500 hover:text-gray-800 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>

                    </div>
                </div>
            </form>


            {{-- RIGHT --}}
            <div class="flex items-center gap-4">

                {{-- Filter --}}
                <form method="GET" action="{{ route('peminjam.dashboard') }}" class="relative hidden sm:block">

                    <button type="button"
                        onclick="document.getElementById('filterBox').classList.toggle('hidden')"
                        class="flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-100 transition">
                        Filter
                    </button>

                    <div id="filterBox"
                        class="hidden absolute right-0 mt-3 w-64 bg-white shadow-lg rounded-xl p-4 space-y-4 z-50">

                        {{-- Status --}}
                        <div>
                            <label class="text-xs text-gray-500">Status</label>
                            <select name="status" class="w-full mt-1 border rounded-lg px-2 py-1 text-sm">
                                <option value="">Semua</option>
                                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                <option value="empty" {{ request('status') == 'empty' ? 'selected' : '' }}>Habis</option>
                            </select>
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label class="text-xs text-gray-500">Harga Minimum</label>
                            <input type="number" name="min_price" value="{{ request('min_price') }}"
                                class="w-full mt-1 border rounded-lg px-2 py-1 text-sm">
                        </div>

                        <div>
                            <label class="text-xs text-gray-500">Harga Maximum</label>
                            <input type="number" name="max_price" value="{{ request('max_price') }}"
                                class="w-full mt-1 border rounded-lg px-2 py-1 text-sm">
                        </div>

                        {{-- Sorting --}}
                        <div>
                            <label class="text-xs text-gray-500">Urutkan</label>
                            <select name="sort" class="w-full mt-1 border rounded-lg px-2 py-1 text-sm">
                                <option value="">Default</option>
                                <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
                                <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Harga Termahal</option>
                                <option value="stok" {{ request('sort') == 'stok' ? 'selected' : '' }}>Stok Terbanyak</option>
                            </select>
                        </div>

                        <div class="flex justify-between pt-2">
                            <a href="{{ route('peminjam.dashboard') }}" class="text-sm text-gray-500">
                                Reset
                            </a>
                            <button type="submit"
                                class="bg-indigo-600 text-white text-sm px-3 py-1 rounded-lg">
                                Terapkan
                            </button>
                        </div>

                    </div>
                </form>


                {{-- Cart --}}
                <a href="{{ route('peminjam.keranjang.index') }}" class="relative p-2 rounded-full hover:bg-gray-100 transition">
                    <img src="{{ asset('image/icon-keranjang.svg') }}" alt="icon keranjang" class="w-6 h-6">
                </a>


                {{-- Auth --}}
                @auth
                    {{-- profile --}}
                    <a href="{{ route('peminjam.profile') }}">
                        <div class="flex items-center gap-3 pl-3 border-l border-gray-200">
                            <div class="w-10 h-10 rounded-full bg-linear-to-tr from-indigo-500 to-purple-600 flex items-center justify-center  text-white text-sm font-semibold shadow">
                                {{ strtoupper(auth()->user()->name[0]) }}
                            </div>
    
                            <div class="hidden sm:flex flex-col text-sm leading-tight">
                                <span class="font-semibold text-gray-800">
                                    {{ auth()->user()->name }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ auth()->user()->role }}
                                </span>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full  bg-gray-900 text-white  text-sm font-medium hover:bg-gray-800 transition">
                        Register
                    </a>
                @endauth

            </div>

        </div>
    </div>

    {{-- CONTENT --}}
    <div class="pt-16 flex">

        {{-- Toggle checkbox --}}
        <input type="checkbox" id="sidebar-toggle" class="hidden peer">

        {{-- ================= SIDEBAR ================= --}}
        @isset($dengan_sidebar)
            <aside class="fixed top-0 left-0 w-64 h-screen bg-white border-r border-gray-200 shadow-lg transform -translate-x-full transition duration-300 ease-in-out peer-checked:translate-x-0 lg:translate-x-0 z-40 flex flex-col">
                <nav class="p-6 space-y-2 text-sm font-medium text-gray-700">
                    <div class="flex items-center gap-3 mb-12">
                        <a href="{{ route('peminjam.dashboard') }}" class="flex items-center gap-3">
                            <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD..." alt="Profile"
                                class="w-10 h-10 rounded-full object-cover">
    
                            <span class="text-xl font-semibold text-gray-800 tracking-tight">
                                Fish Gear
                            </span>
                        </a>
                    </div>

                    <a href="{{ route('peminjam.dashboard') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('peminjam.dashboard') ? 'bg-gray-900 text-white shadow-md' : 'hover:bg-gray-100 hover:text-gray-900 text-gray-500' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('peminjam.riwayat-penyewaan') }}" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('peminjam.riwayat-penyewaan') ? 'bg-gray-900 text-white shadow-md' : 'hover:bg-gray-100 hover:text-gray-900 text-gray-500' }}">
                        Riwayat Peminjaman
                    </a>

                    @if (auth()->user()->role == 'admin')
                        <a href="/" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 hover:bg-gray-100 hover:text-gray-900 text-gray-500">
                            Users
                        </a>

                        <a href="/" class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 hover:bg-gray-100 hover:text-gray-900 text-gray-500">
                            Settings
                        </a>
                    @endif

                </nav>

                <form method="POST" action="{{ route('logout') }}" class="px-6 pb-6 mt-auto">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-red-200 text-red-600 font-medium text-sm hover:bg-red-50 hover:border-red-300 transition-all duration-200">
                        Logout
                    </button>
                </form>

            </aside>


            {{-- Overlay mobile --}}
            <label for="sidebar-toggle" class="fixed inset-0 bg-black/40 hidden peer-checked:block lg:hidden z-30"></label>
        @endisset

        {{-- ================= MAIN CONTENT ================= --}}
        <main class="flex-1 {{ isset($dengan_sidebar) && $dengan_sidebar ? 'lg:ml-64' : '' }} mt-6 p-6 min-h-[calc(100vh-4rem)] ">
            @yield('content')
        </main>

    </div>

    @yield('script')
</body>

</html>
