<x-app-layout>
    <x-slot name="header">
        <div class="data-management-header">
            <div class="reports-header-content flex items-center justify-between gap-6 p-5 sm:p-6">
                <div class="flex items-center gap-4">
                    <div class="data-management-header-icon">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="data-management-header-title">{{ __('Edit Issue') }}</h2>
                        <p class="data-management-header-description">Perbarui detail issue yang sudah ada.</p>
                    </div>
                </div>

                <a href="{{ route('issues.index') }}" class="reports-back-button">Kembali</a>
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="data-management-card-title">Perbarui Issue</h3>
                            <p class="data-management-card-description">Ubah informasi issue tanpa mengganggu laporan terkait.</p>
                        </div>
                    </div>
                </div>

                <div class="data-management-card-body">
                    <form action="{{ route('issues.update', $issue) }}" method="POST" class="data-management-form-grid">
                        @csrf
                        @method('PUT')

                        <div class="data-management-field">
                            <label for="name" class="data-management-label">Nama</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $issue->name) }}" class="data-management-input" required>
                            @error('name')
                            <p class="data-management-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="data-management-field">
                            <label for="description" class="data-management-label">Deskripsi</label>
                            <textarea id="description" name="description" rows="5" class="data-management-textarea">{{ old('description', $issue->description) }}</textarea>
                            @error('description')
                            <p class="data-management-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="data-management-form-actions">
                            <a href="{{ route('issues.index') }}" class="data-management-cancel-button">Batal</a>
                            <button type="submit" class="data-management-submit-button">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>