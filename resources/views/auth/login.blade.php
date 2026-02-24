@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
    <div class="w-full max-w-md space-y-8">

        {{-- LOGO + TITLE --}}
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-600 mb-4">
                <!-- Icon Fish (SVG manual) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4c-4 0-7 3-7 6s3 6 7 6 7-3 7-6-3-6-7-6zM5 12l-2 2m16-2l2 2" />
                </svg>
            </div>

            <h1 class="text-3xl font-bold tracking-tight text-gray-800">
                FishGear
            </h1>
            <p class="mt-1 text-gray-500">
                Professional Fishing Gear Rental
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-white border border-gray-200 shadow-lg rounded-xl">
            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold">Sign In</h2>
                    <p class="text-sm text-gray-500">
                        Masukkan data diri anda
                    </p>
                </div>

                <div class="p-6 space-y-4">

                    {{-- EMAIL --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input
                            type="email"
                            name="email"
                            placeholder="you@example.com"
                            required
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Password</label>
                        <input
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    {{-- ERROR MESSAGE --}}
                    @if($errors->any())
                        <div class="text-red-500 text-sm">
                            {{ $errors->first() }}
                        </div>
                    @endif

                </div>

                <div class="p-6 border-t flex flex-col gap-3">
                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
                    >
                        Sign In
                    </button>

                    <p class="text-sm text-gray-500 text-center">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                           class="text-blue-600 font-medium hover:underline">
                            Sign up
                        </a>
                    </p>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection