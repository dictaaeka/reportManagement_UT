<x-guest-layout>
    <x-slot name="title">Masuk ke akun kamu</x-slot>
    <x-slot name="description">Kelola laporan dan data operasional</x-slot>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="data-management-label">{{ __('Email') }}</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="nama@perusahaan.com"
                class="data-management-input"
                required
                autofocus
                autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="data-management-label">{{ __('Password') }}</label>
            <input
                id="password"
                type="password"
                name="password"
                placeholder="••••••••"
                class="data-management-input"
                required
                autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-3 pt-1">
            <label for="remember_me" class="auth-remember-label">
                <input id="remember_me" type="checkbox" name="remember">
                <span>{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
            <a class="auth-forgot-link" href="{{ route('password.request') }}">
                {{ __('Lupa password?') }}
            </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="data-management-submit-button w-full">
                {{ __('Log in') }}
            </button>
        </div>
    </form>

    @if (Route::has('register'))
    <p class="auth-footer-text">
        {{ __('Belum punya akun?') }}
        <a href="{{ route('register') }}" class="auth-footer-link">{{ __('Daftar') }}</a>
    </p>
    @endif
</x-guest-layout>