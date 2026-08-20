<x-app-layout>

    {{-- =====================================================
        HEADER
    ====================================================== --}}
    <x-slot name="header">

        <div class="data-management-header">

            <div class="data-management-header-content flex items-center justify-between gap-6 p-5 sm:p-6">

                <div class="flex items-center gap-4">

                    {{-- Icon --}}
                    <div class="data-management-header-icon">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.7"
                            stroke="currentColor"
                            aria-hidden="true">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M18 7.5a3 3 0 11-6 0 3 3 0 016 0zM6 19.5a6 6 0 0112 0M19.5 12v6m3-3h-6" />

                        </svg>

                    </div>


                    {{-- Title --}}
                    <div>

                        <h2 class="data-management-header-title">
                            Tambah User
                        </h2>

                        <p class="data-management-header-description">
                            Buat akun baru untuk pengguna Report Management.
                        </p>

                    </div>

                </div>


                {{-- Back --}}
                <a
                    href="{{ route('users.index') }}"
                    class="reports-back-button">

                    Kembali

                </a>

            </div>

        </div>

    </x-slot>


    {{-- =====================================================
        PAGE CONTENT
    ====================================================== --}}
    <div class="py-6">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =================================================
                VALIDATION ERROR
            ================================================= --}}
            @if ($errors->any())

            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4">

                <div class="flex items-start gap-3">

                    <svg
                        class="h-5 w-5 shrink-0 text-red-500 mt-0.5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 11-18 0
                               9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />

                    </svg>


                    <div>

                        <p class="text-sm font-semibold text-red-800">
                            Terdapat kesalahan pada form.
                        </p>

                        <ul class="mt-1 text-sm text-red-700 list-disc list-inside">

                            @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

            @endif


            {{-- =================================================
                USER FORM CARD
            ================================================== --}}
            <div class="data-management-card">


                {{-- CARD HEADER --}}
                <div class="data-management-card-header">

                    <div class="data-management-card-header-inner">

                        {{-- Icon --}}
                        <div class="data-management-card-icon">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                aria-hidden="true">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18 7.5a3 3 0 11-6 0 3 3 0 016 0zM6 19.5a6 6 0 0112 0M19.5 12v6m3-3h-6" />

                            </svg>

                        </div>


                        <div>

                            <h3 class="data-management-card-title">
                                Informasi Akun
                            </h3>

                            <p class="data-management-card-description">
                                Isi data pengguna di bawah ini.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- CARD BODY --}}
                <div class="data-management-card-body">

                    <form
                        action="{{ route('users.store') }}"
                        method="POST">

                        @csrf


                        {{-- =================================================
                            FORM GRID
                        ================================================== --}}
                        <div class="data-management-form-grid">


                            {{-- Nama --}}
                            <div class="data-management-field">

                                <label
                                    for="name"
                                    class="data-management-label">

                                    Nama

                                </label>

                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="data-management-input"
                                    placeholder="Masukkan nama pengguna"
                                    required>

                                @error('name')

                                <p class="data-management-error">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>


                            {{-- Email --}}
                            <div class="data-management-field">

                                <label
                                    for="email"
                                    class="data-management-label">

                                    Email

                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="data-management-input"
                                    placeholder="contoh@email.com"
                                    required>

                                @error('email')

                                <p class="data-management-error">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>


                            {{-- Password --}}
                            <div class="data-management-field">

                                <label for="password" class="data-management-label">
                                    Password
                                </label>

                                <div class="relative">

                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        class="data-management-input"
                                        style="width: 100%; padding-right: 44px;"
                                        placeholder="Minimal 8 karakter"
                                        required>

                                    <button
                                        type="button"
                                        onclick="togglePassword('password', 'password-eye', 'password-eye-off')"
                                        style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); display: flex; align-items: center; justify-content: center; background: none; border: none; padding: 0; cursor: pointer; color: #9ca3af;"
                                        onmouseover="this.style.color='#6366f1'"
                                        onmouseout="this.style.color='#9ca3af'"
                                        aria-label="Tampilkan password">

                                        {{-- Eye --}}
                                        <svg
                                            id="password-eye"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.8"
                                            stroke="currentColor">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5.25 12 5.25
                       c4.477 0 8.268 2.693 9.542 6.75
                       C20.268 16.057 16.477 18.75 12 18.75
                       c-4.477 0-8.268-2.693-9.542-6.75z" />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>


                                        {{-- Eye Off --}}
                                        <svg
                                            id="password-eye-off"
                                            class="h-5 w-5 hidden"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.8"
                                            stroke="currentColor">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 3l18 18" />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M10.584 10.587a2 2 0 002.829 2.829" />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9.88 5.09A9.72 9.72 0 0112 4.75
                                                    c4.477 0 8.268 2.693 9.542 6.75
                                                    a9.77 9.77 0 01-3.17 4.445M6.228 6.228
                                                    A9.77 9.77 0 002.458 12
                                                    C3.732 16.057 7.523 18.75 12 18.75
                                                    c1.61 0 3.117-.392 4.446-1.084" />
                                        </svg>

                                    </button>

                                </div>

                                @error('password')
                                <p class="data-management-error">{{ $message }}</p>
                                @enderror

                            </div>


                            {{-- Konfirmasi Password --}}
                            <div class="data-management-field">

                                <label for="password_confirmation" class="data-management-label">
                                    Konfirmasi Password
                                </label>

                                <div class="relative">

                                    <input
                                        id="password_confirmation"
                                        type="password"
                                        name="password_confirmation"
                                        class="data-management-input"
                                        style="width: 100%; padding-right: 44px;"
                                        placeholder="Masukkan kembali password"
                                        required>

                                    <button
                                        type="button"
                                        onclick="togglePassword('password_confirmation', 'confirmation-eye', 'confirmation-eye-off')"
                                        style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); display: flex; align-items: center; justify-content: center; background: none; border: none; padding: 0; cursor: pointer; color: #9ca3af;"
                                        onmouseover="this.style.color='#6366f1'"
                                        onmouseout="this.style.color='#9ca3af'"
                                        aria-label="Tampilkan konfirmasi password">

                                        <svg
                                            id="confirmation-eye"
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.8"
                                            stroke="currentColor">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5.25 12 5.25
                       c4.477 0 8.268 2.693 9.542 6.75
                       C20.268 16.057 16.477 18.75 12 18.75
                       c-4.477 0-8.268-2.693-9.542-6.75z" />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>

                                        <svg
                                            id="confirmation-eye-off"
                                            class="h-5 w-5 hidden"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.8"
                                            stroke="currentColor">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 3l18 18" />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M10.584 10.587a2 2 0 002.829 2.829" />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9.88 5.09A9.72 9.72 0 0112 4.75
                                                c4.477 0 8.268 2.693 9.542 6.75
                                                a9.77 9.77 0 01-3.17 4.445M6.228 6.228
                                                A9.77 9.77 0 002.458 12
                                                C3.732 16.057 7.523 18.75 12 18.75
                                                c1.61 0 3.117-.392 4.446-1.084" />
                                        </svg>

                                    </button>

                                </div>

                            </div>


                            {{-- Role --}}
                            <div class="data-management-field">

                                <label
                                    for="role"
                                    class="data-management-label">

                                    Role

                                </label>

                                <select
                                    id="role"
                                    name="role"
                                    class="data-management-input"
                                    required>

                                    <option value="user"
                                        {{ old('role', 'user') === 'user' ? 'selected' : '' }}>
                                        User
                                    </option>

                                    <option value="admin"
                                        {{ old('role') === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                </select>

                                @error('role')

                                <p class="data-management-error">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>

                        </div>


                        {{-- =================================================
                            ACTIONS
                        ================================================== --}}
                        <div class="data-management-form-actions">
                            <a href="{{ route('users.index') }}" class="data-management-cancel-button">
                                Batal
                            </a>

                            <button type="submit" class="data-management-submit-button">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script>
        function togglePassword(inputId, eyeId, eyeOffId) {

            const input = document.getElementById(inputId);
            const eye = document.getElementById(eyeId);
            const eyeOff = document.getElementById(eyeOffId);

            if (input.type === 'password') {

                input.type = 'text';

                eye.classList.add('hidden');
                eyeOff.classList.remove('hidden');

            } else {

                input.type = 'password';

                eye.classList.remove('hidden');
                eyeOff.classList.add('hidden');

            }
        }
    </script>
</x-app-layout>