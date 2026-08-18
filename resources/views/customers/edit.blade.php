<x-app-layout>
    <x-slot name="header">
        <div class="data-management-header">
            <div class="reports-header-content flex items-center justify-between gap-6 p-5 sm:p-6">
                <div class="flex items-center gap-4">
                    <div class="data-management-header-icon">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.001 9.001 0 01-6 0m6 0a9.001 9.001 0 006-8.378M9 19.128a9.001 9.001 0 00-6-8.378m12 0a9.001 9.001 0 00-6-8.378M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="data-management-header-title">{{ __('Edit Customer') }}</h2>
                        <p class="data-management-header-description">
                            Perbarui nama customer yang sudah tersedia.
                        </p>
                    </div>
                </div>

                <a href="{{ route('customers.index') }}" class="reports-back-button">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="reports-page py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="data-management-card">

                <div class="data-management-card-header">
                    <div class="data-management-card-header-inner">
                        <div class="data-management-card-icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.001 9.001 0 01-6 0m6 0a9.001 9.001 0 006-8.378M9 19.128a9.001 9.001 0 00-6 8.378m12 0a9.001 9.001 0 00-6-8.378M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="data-management-card-title">Perbarui Customer</h3>
                            <p class="data-management-card-description">
                                Ubah nama customer tanpa mengganggu laporan terkait.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="data-management-card-body">
                    <form action="{{ route('customers.update', $customer) }}" method="POST" class="data-management-form-grid">
                        @csrf
                        @method('PUT')

                        <div class="data-management-field">
                            <label for="name" class="data-management-label">
                                Nama Customer
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name', $customer->name) }}"
                                class="data-management-input"
                                placeholder="Masukkan nama customer"
                                required
                                autofocus
                            >

                            @error('name')
                                <p class="data-management-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="data-management-form-actions">
                            <a href="{{ route('customers.index') }}" class="data-management-cancel-button">
                                Batal
                            </a>

                            <button type="submit" class="data-management-submit-button">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>