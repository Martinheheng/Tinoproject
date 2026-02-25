<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="relative min-h-screen flex items-center justify-center">

    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('https://api.builder.io/api/v1/image/assets/TEMP/518b7cf41667e20219ed2a137f96d46d1e6782aa?width=2880');">
    </div>

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- Content -->
    <div class="relative z-10 w-full flex justify-center px-6 py-16">

        <div class="w-full max-w-[500px]
                    rounded-[25px]
                    bg-[#D9D9D9]
                    shadow-[0_25px_60px_rgba(0,0,0,0.4)]
                    px-[52px] py-[64px]">

            <h1 class="text-white font-bold text-[48px] text-center mb-[54px] font-inter">
                Login
            </h1>

            <form method="POST" action="{{ route('login.process') }}" class="flex flex-col gap-[18px]">
                @csrf

                <!-- Email -->
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukan Email"
                    class="w-full h-[51px] rounded-[15px] border border-black 
                           bg-white shadow-[0_2px_8px_0_rgba(0,0,0,0.25)] 
                           px-[13px] text-[13px] font-medium font-inter 
                           text-black/80 placeholder:text-black/80 
                           outline-none focus:ring-2 focus:ring-teal-400/60"
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
                    class="w-full h-[51px] rounded-[15px] border border-black 
                           bg-white shadow-[0_2px_8px_0_rgba(0,0,0,0.25)] 
                           px-[13px] text-[13px] font-medium font-inter 
                           text-black/80 placeholder:text-black/80 
                           outline-none focus:ring-2 focus:ring-teal-400/60"
                    required
                />
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror

                <p class="text-[13px] font-medium font-inter text-black pl-[1px]">
                    Lupa Password?
                </p>

                <p class="text-[13px] font-medium font-inter text-black pl-[1px]">
                    Belum Punya Akun?
                    <a href="{{ route('register') }}" class="text-cyan-500 hover:text-cyan-600 transition-colors">
                        Daftar Sekarang
                    </a>
                </p>

                <button
                    type="submit"
                    class="w-full h-[49px] rounded-[20px] border border-black/80 
                           text-white font-bold text-[24px] font-inter 
                           leading-normal mt-1 
                           bg-gradient-to-r from-[#40D884] to-[#3097CA]
                           hover:opacity-90 active:opacity-80 
                           transition-opacity cursor-pointer"
                >
                    Login
                </button>
            </form>

        </div>
    </div>
</body>
</html>