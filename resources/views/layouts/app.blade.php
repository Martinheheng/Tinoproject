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
    <div class="bg-teal-500 text-white px-6 py-4 flex justify-between fixed top-0 left-0 z-10 w-full">

        <div class="flex items-center">
            <div class="flex items-center text-xl">
                <img src="data:image/jpeg;base64,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"
                    alt="Profile" class="w-15 h-15 mr-2 rounded-full">
                <b>Fish Gear</b>
            </div>
        </div>

        <div class="flex items-center gap-x-12">
            <div class="flex items-center border border-gray-100 px-3 rounded-2xl bg-white">
                <input type="text" name="search" class="px-3 py-2 focus:outline-none text-zinc-800"
                    placeholder="Cari Peralatan Disini">
                <button class="ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" style="stroke: #292929;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
            <button
                class="flex items-center gap-1 border border-gray-100 px-3 py-2 rounded-xl hover:bg-gray-50/50 cursor-pointer transition">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.78584 3C4.24726 3 3 4.24726 3 5.78584C3 6.59295 3.28872 7.37343 3.81398 7.98623L6.64813 11.2927C7.73559 12.5614 8.33333 14.1773 8.33333 15.8483V18C8.33333 19.6569 9.67648 21 11.3333 21H12.6667C14.3235 21 15.6667 19.6569 15.6667 18V15.8483C15.6667 14.1773 16.2644 12.5614 17.3519 11.2927L20.186 7.98624C20.7113 7.37343 21 6.59294 21 5.78584C21 4.24726 19.7527 3 18.2142 3H5.78584Z"
                            fill="#ffff"></path>
                    </g>
                </svg>
                <span class="text-lg font-semibold">Filter</span>
            </button>
            <img src="{{ asset('image/icon-keranjang.svg') }}" alt="icon keranjang" class="w-10 h-10">
        </div>

        @auth
            <div class="text-lg font-semibold flex gap-x-6 items-center justify-center">
                <h2>Welcome, {{ auth()->user()->name }}</h2>
                <div class="separator h-8 w-1 bg-gray-300"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="ml-2 bg-red-300 text-red-800 px-2 rounded">Logout</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="mr-4 hover:underline">Login</a>
            <a href="{{ route('register') }}" class="hover:underline">Register</a>
        @endauth

    </div>

    {{-- CONTENT --}}
    <div class="pt-16 flex">

        {{-- Toggle checkbox --}}
        <input type="checkbox" id="sidebar-toggle" class="hidden peer">

        {{-- ================= SIDEBAR ================= --}}
        @isset($dengan_sidebar)
            <aside
                class="
                    fixed top-22 left-0
                    w-64 h-[calc(100vh-4rem)]
                    bg-teal-500 text-white
                    transform -translate-x-full
                    transition duration-200
                    peer-checked:translate-x-0
                    lg:translate-x-0
                    z-40
            ">

                <nav class="p-6 space-y-3 font-semibold text-lg">

                    <a href="{{ route('peminjam.dashboard') }}"
                        class="block px-3 py-2 rounded transition
                {{ request()->routeIs('peminjam.dashboard') ? 'text-white' : 'text-white/50 hover:text-white' }}">
                        Dashboard
                    </a>

                    <a href="/"
                        class="block px-3 py-2 rounded transition
                text-white/50 hover:text-white">
                        Users
                    </a>

                    <a href="/"
                        class="block px-3 py-2 rounded transition
                text-white/50 hover:text-white">
                        Settings
                    </a>

                </nav>

            </aside>


            {{-- Overlay mobile --}}
            <label for="sidebar-toggle"
                class="fixed inset-0 bg-black/40 hidden
                    peer-checked:block lg:hidden z-30">
            </label>
        @endisset

        {{-- ================= MAIN CONTENT ================= --}}
        <main class="
        flex-1
        {{ isset($dengan_sidebar) && $dengan_sidebar ? 'lg:ml-64' : '' }}
        mt-6
        p-6
        min-h-[calc(100vh-4rem)]
    ">
            @yield('content')
        </main>

    </div>

    @yield('script')
</body>

</html>
