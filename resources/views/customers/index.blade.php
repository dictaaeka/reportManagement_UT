<x-app-layout>
    <x-slot name="header">
        <div class="data-management-header">
            <div class="reports-header-content flex items-center justify-between gap-6 p-5 sm:p-6">
                <div class="flex items-center gap-4">
                    <div class="data-management-header-icon">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.001 9.001 0 01-6 0m6 0a9.001 9.001 0 006-8.378M9 19.128a9.001 9.001 0 00-6-8.378m12 8.378v.75a3.375 3.375 0 01-3.375 3.375h-5.25A3.375 3.375 0 013.375 19.878v-.75m12 0a9.001 9.001 0 00-6-8.378M9 19.128a9.001 9.001 0 016-8.378M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="data-management-header-title">{{ __('Customers') }}</h2>
                        <p class="data-management-header-description">
                            Kelola daftar customer yang digunakan pada seluruh laporan.
                        </p>
                    </div>
                </div>

                <a href="{{ route('customers.create') }}" class="reports-upload-button">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Customer
                </a>
            </div>
        </div>
    </x-slot>

    <div class="reports-page py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-5 rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="data-management-card">
                <div class="data-management-card-header">
                    <div class="data-management-card-header-inner">
                        <div class="data-management-card-icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.001 9.001 0 01-6 0m6 0a9.001 9.001 0 006-8.378M9 19.128a9.001 9.001 0 00-6-8.378m12 0a9.001 9.001 0 00-6-8.378M9 19.128a9.001 9.001 0 016-8.378M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="data-management-card-title">Daftar Customer</h3>
                            <p class="data-management-card-description">
                                Semua customer yang tersedia untuk digunakan pada laporan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="data-management-card-body">
                    @if ($customers->isEmpty())
                        <div class="data-management-empty-state">
                            <div class="data-management-empty-icon">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.001 9.001 0 01-6 0m6 0a9.001 9.001 0 006-8.378M9 19.128a9.001 9.001 0 00-6-8.378m12 0a9.001 9.001 0 00-6-8.378M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <p class="data-management-empty-title">Belum ada customer</p>

                            <p class="data-management-empty-text">
                                Tambahkan customer pertama untuk mulai mengelola laporan.
                            </p>
                        </div>
                    @else
                        <div class="data-management-table-wrapper">
                            <table class="data-management-table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Nama Customer</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td class="data-management-resource-name">
                                                {{ $customer->name }}
                                            </td>

                                            <td style="text-align: center;">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a
                                                        href="{{ route('customers.edit', $customer) }}"
                                                        class="inline-flex px-3 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium transition hover:bg-indigo-700"
                                                        aria-label="Edit customer"
                                                    >
                                                        Edit
                                                    </a>

                                                    <form
                                                        action="{{ route('customers.destroy', $customer) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Hapus customer ini?');"
                                                    >
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="inline-flex px-3 py-2 rounded-lg bg-red-600 text-white text-sm font-medium transition hover:bg-red-700"
                                                            aria-label="Hapus customer"
                                                        >
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>