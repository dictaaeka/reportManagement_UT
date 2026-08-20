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
                                d="M15 19.128a9.38 9.38 0 002.625.372
                                   9.337 9.337 0 004.121-.952
                                   4.125 4.125 0 00-7.533-2.493M15 19.128v-.003
                                   c0-1.113-.285-2.162-.786-3.07M15 19.128v.003
                                   A9.385 9.385 0 0112 19.5
                                   a9.385 9.385 0 01-3-.369m6-12.756
                                   a3 3 0 11-6 0 3 3 0 016 0zm6 3
                                   a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5
                                   0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />

                        </svg>

                    </div>


                    {{-- Title --}}
                    <div>

                        <h2 class="data-management-header-title">
                            User Management
                        </h2>

                        <p class="data-management-header-description">
                            Kelola akun pengguna yang dapat mengakses Report Management.
                        </p>

                    </div>

                </div>


                {{-- Add User --}}
                <a
                    href="{{ route('users.create') }}"
                    class="data-management-submit-button">

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        aria-hidden="true">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4.5v15m7.5-7.5h-15" />

                    </svg>

                    Tambah User

                </a>

            </div>

        </div>

    </x-slot>


    {{-- =====================================================
        PAGE CONTENT
    ====================================================== --}}
    <div class="py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =================================================
                SUCCESS MESSAGE
            ================================================= --}}
            @if (session('success'))

            <div class="mb-5 rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-800">

                {{ session('success') }}

            </div>

            @endif


            {{-- =================================================
                ERROR MESSAGE
            ================================================= --}}
            @if (session('error'))

            <div class="mb-5 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-800">

                {{ session('error') }}

            </div>

            @endif


            {{-- =================================================
                USER TABLE CARD
            ================================================= --}}
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
                                    d="M15 19.128a9.38 9.38 0 002.625.372
                                       9.337 9.337 0 004.121-.952
                                       4.125 4.125 0 00-7.533-2.493M15 19.128v-.003
                                       c0-1.113-.285-2.162-.786-3.07M15 19.128v.003
                                       A9.385 9.385 0 0112 19.5
                                       a9.385 9.385 0 01-3-.369m6-12.756
                                       a3 3 0 11-6 0 3 3 0 016 0zm6 3
                                       a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5
                                       0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />

                            </svg>

                        </div>


                        <div>

                            <h3 class="data-management-card-title">
                                Daftar User
                            </h3>

                            <p class="data-management-card-description">
                                {{ $users->count() }} user terdaftar.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    TABLE
                ================================================== --}}
                <div class="data-management-table-wrapper">

                    <table class="data-management-table">

                        <thead>

                            <tr>

                                <th>
                                    Nama
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Role
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($users as $user)

                            <tr>

                                {{-- NAME --}}
                                <td>

                                    <span class="data-management-resource-name">
                                        {{ $user->name }}
                                    </span>

                                    @if ($user->id === Auth::id())

                                    <div class="data-management-resource-description">
                                        Akun Anda
                                    </div>

                                    @endif

                                </td>


                                {{-- EMAIL --}}
                                <td>

                                    <span class="data-management-resource-description">
                                        {{ $user->email }}
                                    </span>

                                </td>


                                {{-- ROLE --}}
                                <td>

                                    <span class="data-management-resource-name">
                                        {{ ucfirst($user->role) }}
                                    </span>

                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- EDIT --}}

                                        <a href="{{ route('users.edit', $user) }}"
                                        class="inline-flex px-3 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium transition hover:bg-indigo-700" aria-label="Edit users">

                                        Edit

                                        </a>


                                        {{-- DELETE --}}
                                        @if ($user->id !== Auth::id())

                                        <form
                                            action="{{ route('users.destroy', $user) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="inline-flex px-3 py-2 rounded-lg bg-red-600 text-white text-sm font-medium transition hover:bg-red-700" aria-label="Hapus issue">
                                                Hapus
                                            </button>

                                        </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                            @empty

                            {{-- EMPTY STATE --}}
                            <tr>

                                <td colspan="4">

                                    <div class="data-management-empty-state">

                                        <div class="data-management-empty-icon">

                                            <svg
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.8"
                                                stroke="currentColor">

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M15 19.128a9.38 9.38 0 002.625.372
                                                       9.337 9.337 0 004.121-.952
                                                       4.125 4.125 0 00-7.533-2.493
                                                       M15 19.128v-.003
                                                       c0-1.113-.285-2.162-.786-3.07
                                                       M15 19.128v.003A9.385 9.385
                                                       0 0112 19.5a9.385 9.385
                                                       0 01-3-.369" />

                                            </svg>

                                        </div>

                                        <p class="data-management-empty-title">
                                            Belum ada user
                                        </p>

                                        <p class="data-management-empty-text">
                                            Tambahkan user baru untuk mulai menggunakan User Management.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>