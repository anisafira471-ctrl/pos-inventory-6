<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory & Sales</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <!-- Card Container -->
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-sky-100">
        
        <!-- Header Judul -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800">Inventory & Sales</h2>
            <p class="text-sm text-slate-500 mt-1">Silakan login untuk masuk ke sistem UTS</p>
        </div>

        <!-- Session Status / Alert jika ada pesan -->
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       placeholder="contoh: admin@gmail.com"
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition duration-150 text-slate-700">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input id="password" 
                       type="password" 
                       name="password" 
                       required 
                       placeholder="Masukkan password Anda"
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition duration-150 text-slate-700">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Lupa Password -->
            <div class="flex items-center justify-between text-sm pt-1">
                <label class="flex items-center text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-sky-600 border-slate-300 rounded focus:ring-sky-500">
                    <span class="ml-2">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sky-600 hover:text-sky-700 hover:underline">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Tombol Login Biru Soft -->
            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-3 px-4 bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white font-semibold rounded-lg shadow-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 text-center">
                    Masuk ke Sistem
                </button>
            </div>

            <!-- Informasi Akun Demo UTS -->
            <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-400 font-medium mb-1">Akun Demo UTS:</p>
                <p class="text-xs text-slate-600">Admin: <span class="font-semibold text-sky-600">admin@gmail.com</span> | password123</p>
                <p class="text-xs text-slate-600">Staff: <span class="font-semibold text-sky-600">staff@gmail.com</span> | password123</p>
            </div>
        </form>
    </div>

</body>
</html>