<x-app-layout>
    <x-slot name="header">
        <div class="data-management-header">
            <div class="reports-header-content flex items-center justify-between gap-6 p-5 sm:p-6">
                <div class="flex items-center gap-4">
                    <div class="data-management-header-icon">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 10.5-7.5 10.5S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="data-management-header-title">{{ __('Tambah Site') }}</h2>
                        <p class="data-management-header-description">Buat site baru untuk lokasi kerja yang akan dilaporkan.</p>
                    </div>
                </div>

                <a href="{{ route('sites.index') }}" class="reports-back-button">Kembali</a>
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 10.5-7.5 10.5S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="data-management-card-title">Form Site</h3>
                            <p class="data-management-card-description">Isi detail site yang akan ditampilkan di sistem.</p>
                        </div>
                    </div>
                </div>

                <div class="data-management-card-body">
                    <form action="{{ route('sites.store') }}" method="POST" class="data-management-form-grid">
                        @csrf

                        <div class="data-management-field">
                            <label for="name" class="data-management-label">Nama</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" class="data-management-input" required>
                            @error('name')
                            <p class="data-management-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="data-management-field">
                            <label for="location" class="data-management-label">Lokasi</label>
                            <input id="location" type="text" name="location" value="{{ old('location') }}" class="data-management-input">
                            @error('location')
                            <p class="data-management-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="data-management-form-actions">
                            <a href="{{ route('sites.index') }}" class="data-management-cancel-button">Batal</a>
                            <button type="submit" class="data-management-submit-button">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>