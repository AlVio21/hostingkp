<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-center text-blue-800 mb-6">Login ke Sistem</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email"
                              name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password"
                              name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                       name="remember">
                <label for="remember_me" class="ms-2 text-sm text-gray-600">
                    {{ __('Ingat saya') }}
                </label>
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif

                <x-primary-button>
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Tautan ke halaman register -->
        <div class="text-center mt-4">
            <span class="text-sm">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar sekarang</a></span>
        </div>

        <!-- Tombol untuk kembali ke halaman utama -->
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="text-blue-600 hover:underline">Kembali ke Halaman Utama</a>
        </div>
    </div>
</x-guest-layout>
