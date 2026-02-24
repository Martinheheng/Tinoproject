@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-xl shadow-md w-96">

        <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>

        @if($errors->any())
            <div class="mb-4 text-red-500 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Nama</label>
                <input type="text" 
                       name="name"
                       value="{{ old('name') }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" 
                       name="email"
                       value="{{ old('email') }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Password</label>
                <input type="password" 
                       name="password"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Konfirmasi Password </label>
                <input type="password" 
                       name="password_confirmation"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       required>
            </div>

            <div class="mb-6">
                <label class="block mb-1">Alamat</label>
                <input type="text" 
                       name="alamat"
                       value="{{ old('alamat') }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                       required>
            </div>

            <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                Register
            </button>
        </form>

    </div>
</div>

@endsection