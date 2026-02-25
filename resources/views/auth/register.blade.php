<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="min-h-screen w-full flex items-center justify-center bg-cover bg-center px-4 py-10" style="background-image: url('https://api.builder.io/api/v1/image/assets/TEMP/518b7cf41667e20219ed2a137f96d46d1e6782aa?width=2880');">
        <div class="register-card w-full max-w-[500px] rounded-[25px] border border-black shadow-[0_4px_8px_5px_rgba(0,0,0,0.25)] px-[52px] py-[54px] flex flex-col">
            <h1 class="text-white font-bold text-[48px] leading-normal text-center mb-[54px] font-inter">
                Register
            </h1>

            <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-[18px]">
                @csrf

                <!-- Username -->
                <input
                    type="text"
                    name="name"
                    value="{{ old('username') }}"
                    placeholder="Masukan Nama Pengguna"
                    class="w-full h-[51px] rounded-[15px] border border-black bg-white shadow-[0_2px_8px_0_rgba(0,0,0,0.25)] px-[13px] text-[13px] font-medium font-inter text-black/80 placeholder:text-black/80 outline-none focus:ring-2 focus:ring-teal-400/60"
                    required
                />
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror

                <!-- Email -->
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukan Email"
                    class="w-full h-[51px] rounded-[15px] border border-black bg-white shadow-[0_2px_8px_0_rgba(0,0,0,0.25)] px-[13px] text-[13px] font-medium font-inter text-black/80 placeholder:text-black/80 outline-none focus:ring-2 focus:ring-teal-400/60"
                    required
                />
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror

                <!-- Password -->
                <input
                    type="password"
                    name="password"
                    placeholder="Masukan Password"
                    class="w-full h-[51px] rounded-[15px] border border-black bg-white shadow-[0_2px_8px_0_rgba(0,0,0,0.25)] px-[13px] text-[13px] font-medium font-inter text-black/80 placeholder:text-black/80 outline-none focus:ring-2 focus:ring-teal-400/60"
                    required
                />
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror

                <!-- Confirm Password -->
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Konfirmasi Password"
                    class="w-full h-[51px] rounded-[15px] border border-black bg-white shadow-[0_2px_8px_0_rgba(0,0,0,0.25)] px-[13px] text-[13px] font-medium font-inter text-black/80 placeholder:text-black/80 outline-none focus:ring-2 focus:ring-teal-400/60"
                    required
                />
                <input
                    type="text"
                    name="alamat"
                    value="{{ old('alamat') }}"
                    placeholder="Masukan Alamat"
                    class="w-full h-[51px] rounded-[15px] border border-black bg-white px-[13px] text-[13px] font-medium"
                    required
                />
                @error('alamat')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror

                <!-- Already have account -->
                <p class="text-[13px] font-medium font-inter text-black pl-[1px]">
                    Sudah Punya Akun?
                    <a href="{{ route('login') }}" class="text-cyan-500 hover:text-cyan-600 transition-colors">
                        Masuk Sekarang
                    </a>
                </p>

                <!-- Register Button -->
                <button
                    type="submit"
                    class="register-btn w-full h-[49px] rounded-[20px] border border-black/80 text-white font-bold text-[24px] font-inter leading-normal mt-1 hover:opacity-90 active:opacity-80 transition-opacity cursor-pointer"
                >
                    Register
                    </button>
                    @if(session('success'))
                    <div class="bg-green-500 text-white p-3 rounded mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>