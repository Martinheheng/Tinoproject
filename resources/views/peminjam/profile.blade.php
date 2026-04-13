@extends('layouts.app', ['title' => 'Profile', 'dengan_sidebar' => true])

@section('content')
<div class="min-h-screen bg-linear-to-br from-slate-50 via-white to-slate-100 py-10 px-4">
    <div class="max-w-5xl mx-auto">

        {{-- Card Container --}}
        <div class="bg-white shadow-xl rounded-3xl overflow-hidden border border-slate-200">

            {{-- Header --}}
            <div class="relative bg-linear-to-r from-indigo-500 to-purple-600 h-40">
                <div class="absolute -bottom-16 left-8">
                    <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg bg-white flex items-center justify-center text-4xl font-bold text-indigo-600">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="pt-20 pb-10 px-6 md:px-10">

                {{-- Name & Role --}}
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-slate-800">
                            {{ $user->name }}
                        </h1>
                        <p class="text-slate-500 mt-1">
                            Role:
                            <span class="inline-block px-3 py-1 text-sm rounded-full bg-indigo-100 text-indigo-600 font-medium">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                    </div>

                    {{-- <a href="{{ route('peminjam.profile.edit', $user->id) }}"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition duration-200 text-center">
                        Edit Profile
                    </a> --}}
                </div>

                {{-- Info Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Email --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 hover:shadow-md transition">
                        <p class="text-sm text-slate-500 mb-1">Email</p>
                        <p class="text-slate-800 font-medium break-all">
                            {{ $user->email }}
                        </p>
                    </div>

                    {{-- Telepon --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 hover:shadow-md transition">
                        <p class="text-sm text-slate-500 mb-1">Telepon</p>
                        <p class="text-slate-800 font-medium">
                            {{ $user->telepon ?? '-' }}
                        </p>
                    </div>

                    {{-- Role --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 hover:shadow-md transition">
                        <p class="text-sm text-slate-500 mb-1">Role</p>
                        <p class="text-slate-800 font-medium">
                            {{ ucfirst($user->role) }}
                        </p>
                    </div>

                    {{-- Alamat --}}
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 hover:shadow-md transition md:col-span-2">
                        <p class="text-sm text-slate-500 mb-1">Alamat</p>
                        <p class="text-slate-800 font-medium">
                            {{ $user->alamat ?? '-' }}
                        </p>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
