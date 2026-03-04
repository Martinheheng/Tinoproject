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


            {{-- RIGHT --}}
            <div class="flex items-center gap-4">

                {{-- Filter --}}
                <button
                    class="hidden sm:flex items-center gap-2  px-4 py-2 rounded-full  border border-gray-200  text-gray-600 text-sm font-medium hover:bg-gray-100  transition">

                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.78584 3C4.24726 3 3 4.24726 3 5.78584C3 6.59295 3.28872 7.37343 3.81398 7.98623L6.64813 11.2927C7.73559 12.5614 8.33333 14.1773 8.33333 15.8483V18C8.33333 19.6569 9.67648 21 11.3333 21H12.6667C14.3235 21 15.6667 19.6569 15.6667 18V15.8483C15.6667 14.1773 16.2644 12.5614 17.3519 11.2927L20.186 7.98624C20.7113 7.37343 21 6.59294 21 5.78584C21 4.24726 19.7527 3 18.2142 3H5.78584Z" fill="currentColor" />
                    </svg>

                    Filter
                </button>


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
