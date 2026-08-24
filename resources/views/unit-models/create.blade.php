<x-app-layout>
    <x-slot name="header">
        <div class="data-management-header">
            <div class="reports-header-content flex items-center justify-between gap-6 p-5 sm:p-6">
                <div class="flex items-center gap-4">
                    <div class="data-management-header-icon">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0v9L12 21l-8.25-4.5v-9m16.5 0L12 12 3.75 7.5M12 12v9" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="data-management-header-title">{{ __('Tambah Unit Model') }}</h2>
                        <p class="data-management-header-description">Buat model unit baru untuk digunakan pada laporan.</p>
                    </div>
                </div>

                <a href="{{ route('unit-models.index') }}" class="reports-back-button">Kembali</a>
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0v9L12 21l-8.25-4.5v-9m16.5 0L12 12 3.75 7.5M12 12v9" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="data-management-card-title">Form Unit Model</h3>
                            <p class="data-management-card-description">Isi nama model unit yang akan ditampilkan di sistem.</p>
                        </div>
                    </div>
                </div>

                <div class="data-management-card-body">
                    <form action="{{ route('unit-models.store') }}" method="POST" class="data-management-form-grid">
                        @csrf

                        <div class="data-management-field">
                            <label for="name" class="data-management-label">Nama Unit Model</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" class="data-management-input" required autofocus>
                            @error('name')
                            <p class="data-management-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="data-management-form-actions">
                            <a href="{{ route('unit-models.index') }}" class="data-management-cancel-button">Batal</a>
                            <button type="submit" class="data-management-submit-button">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>