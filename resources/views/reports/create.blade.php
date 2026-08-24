<x-app-layout>

    {{-- HEADER --}}
    <x-slot name="header">

        <div class="reports-header">

            <div class="reports-header-content flex items-center justify-between gap-6 p-5 sm:p-6">

                <div class="flex items-center gap-4">

                    {{-- Icon --}}
                    <div class="reports-header-icon">

                        <svg
                            class="h-7 w-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.7"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 16.5V3.75m0 0L7.5 8.25M12 3.75l4.5 4.5M5.25 13.5v4.875A2.625 2.625 0 007.875 21h8.25a2.625 2.625 0 002.625-2.625V13.5" />

                        </svg>

                    </div>

                    {{-- Upload Laporan --}}
                    <div>

                        <h2 class="reports-header-title">
                            {{ __('Upload Laporan') }}
                        </h2>

                        <p class="reports-header-description">
                            Tambahkan laporan PDF baru ke dalam sistem.
                        </p>

                    </div>

                </div>


                {{-- Back --}}
                <a
                    href="{{ route('reports.index') }}"
                    class="reports-back-button">

                    Kembali

                </a>

            </div>

        </div>

    </x-slot>


    <!-- Page Content -->
    <div class="py-6">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())

            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4">

                <div class="flex items-start gap-3">

                    <svg class="h-5 w-5 shrink-0 text-red-500 mt-0.5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />

                    </svg>

                    <div>

                        <p class="text-sm font-semibold text-red-800">
                            Terdapat kesalahan pada form.
                        </p>

                        <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                </div>

            </div>

            @endif


            <!-- Upload Card -->
            <div class="reports-upload-card">
                <!-- Card Header -->
                <div class="reports-upload-card-header">

                    <div class="reports-upload-card-icon">

                        <svg class="h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12" />

                        </svg>

                    </div>

                    <div>

                        <h3 class="reports-upload-card-title">
                            Informasi Laporan
                        </h3>

                        <p class="reports-upload-card-description">
                            Lengkapi informasi laporan sebelum mengunggah file.
                        </p>

                    </div>

                </div>


                <!-- Card Body -->
                <div class="reports-upload-card-body">

                    <form action="{{ route('reports.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        x-data="{ isSubmitting: false }"
                        @submit="isSubmitting = true">

                        @csrf


                        <!-- Form Grid -->
                        <div class="reports-upload-form-grid">

                            <!-- Customer Name -->
                            <div class="reports-upload-field">

                                <label for="customer_id"
                                    class="reports-upload-label">
                                    Nama Customer
                                </label>

                                <select
                                    id="customer_id"
                                    name="customer_id"
                                    class="reports-upload-select"
                                    required>

                                    <option value="">Pilih Customer</option>

                                    @foreach ($customers as $customer)
                                    <option
                                        value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('customer_id')
                                <p class="reports-upload-error">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>


                            <!-- Issue -->
                            <div class="reports-upload-field">

                                <label for="issue_id"
                                    class="reports-upload-label">
                                    Issue
                                </label>

                                <select
                                    id="issue_id"
                                    name="issue_id"
                                    class="reports-upload-select"
                                    required>

                                    <option value="">
                                        Pilih issue
                                    </option>

                                    @foreach ($issues as $issue)

                                    <option
                                        value="{{ $issue->id }}"
                                        @selected(old('issue_id')==$issue->id)>
                                        {{ $issue->name }}
                                    </option>

                                    @endforeach

                                </select>

                                @error('issue_id')
                                <p class="reports-upload-error">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>


                            <!-- Site -->
                            <div class="reports-upload-field">

                                <label for="site_id"
                                    class="reports-upload-label">
                                    Site
                                </label>

                                <select
                                    id="site_id"
                                    name="site_id"
                                    class="reports-upload-select"
                                    required>

                                    <option value="">
                                        Pilih site
                                    </option>

                                    @foreach ($sites as $site)

                                    <option
                                        value="{{ $site->id }}"
                                        @selected(old('site_id')==$site->id)>
                                        {{ $site->name }}
                                    </option>

                                    @endforeach

                                </select>

                                @error('site_id')
                                <p class="reports-upload-error">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>

                            <!-- Unit Model -->
                            <div class="reports-upload-field">

                                <label
                                    for="unit_model_id"
                                    class="reports-upload-label">
                                    Unit Model
                                </label>

                                <select
                                    id="unit_model_id"
                                    name="unit_model_id"
                                    class="reports-upload-select"
                                    required>

                                    <option value="">
                                        Pilih Unit Model
                                    </option>

                                    @foreach ($unitModels as $unitModel)

                                    <option
                                        value="{{ $unitModel->id }}"
                                        @selected(old('unit_model_id')==$unitModel->id)>
                                        {{ $unitModel->name }}
                                    </option>

                                    @endforeach

                                </select>

                                @error('unit_model_id')
                                <p class="reports-upload-error">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>


                            <!-- Period -->
                            <div class="reports-upload-field">

                                <div class="reports-upload-period">

                                    <!-- Month -->
                                    <div>

                                        <label for="month"
                                            class="reports-upload-label">
                                            Bulan
                                        </label>

                                        <select
                                            id="month"
                                            name="month"
                                            class="reports-upload-select"
                                            required>

                                            <option value="">Pilih Bulan</option>

                                            @php
                                            $months = [
                                            1 => 'Januari',
                                            2 => 'Februari',
                                            3 => 'Maret',
                                            4 => 'April',
                                            5 => 'Mei',
                                            6 => 'Juni',
                                            7 => 'Juli',
                                            8 => 'Agustus',
                                            9 => 'September',
                                            10 => 'Oktober',
                                            11 => 'November',
                                            12 => 'Desember',
                                            ];
                                            @endphp

                                            @foreach ($months as $value => $label)
                                            <option
                                                value="{{ $value }}"
                                                {{ old('month') == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                            @endforeach

                                        </select>

                                        @error('month')
                                        <p class="reports-upload-error">
                                            {{ $message }}
                                        </p>
                                        @enderror

                                    </div>


                                    <!-- Year -->
                                    <div>

                                        <label for="year"
                                            class="reports-upload-label">
                                            Tahun
                                        </label>

                                        <input
                                            id="year"
                                            type="number"
                                            name="year"
                                            value="{{ old('year') }}"
                                            min="1900"
                                            max="2100"
                                            placeholder="2026"
                                            class="reports-upload-input"
                                            required>

                                        @error('year')
                                        <p class="reports-upload-error">
                                            {{ $message }}
                                        </p>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- File Upload -->
                        <div class="reports-upload-file-wrapper">

                            <label for="file"
                                class="reports-upload-label">
                                File PDF
                            </label>

                            <label
                                for="file"
                                class="reports-upload-file">

                                <span class="reports-upload-file-icon">

                                    <svg class="h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.8"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 16.5V3.75m0 0L7.5 8.25M12 3.75l4.5 4.5M5.25 13.5v4.875A2.625 2.625 0 007.875 21h8.25a2.625 2.625 0 002.625-2.625V13.5" />

                                    </svg>

                                </span>

                                <span class="reports-upload-file-title">
                                    Pilih file PDF
                                </span>

                                <span class="reports-upload-file-description">
                                    Klik area ini untuk memilih file
                                </span>

                                <span id="file-name"
                                    class="reports-upload-file-name">
                                </span>

                                <input
                                    id="file"
                                    type="file"
                                    name="file"
                                    accept="application/pdf"
                                    class="sr-only"
                                    required>

                            </label>

                            <p class="reports-upload-file-description">
                                Format yang diperbolehkan: PDF.
                            </p>

                            @error('file')
                            <p class="reports-upload-error">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>


                        <!-- Actions -->
                        <div class="reports-upload-actions">

                            <a href="{{ route('reports.index') }}"
                                class="reports-cancel-button"
                                :class="{ 'pointer-events-none opacity-50': isSubmitting }">

                                Batal

                            </a>

                            <button
                                type="submit"
                                class="reports-submit-button"
                                :disabled="isSubmitting"
                                :class="{ 'opacity-60 cursor-not-allowed': isSubmitting }">

                                <svg x-show="isSubmitting"
                                    x-cloak
                                    class="inline-block h-4 w-4 mr-2 animate-spin"
                                    viewBox="0 0 24 24"
                                    fill="none">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>

                                <span x-text="isSubmitting ? 'Mengunggah...' : 'Upload Laporan'"></span>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <!-- File Name Preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const fileInput = document.getElementById('file');
            const fileName = document.getElementById('file-name');

            if (fileInput && fileName) {

                fileInput.addEventListener('change', function() {

                    if (this.files && this.files.length > 0) {
                        fileName.textContent = this.files[0].name;
                    } else {
                        fileName.textContent = '';
                    }

                });

            }

        });
    </script>

</x-app-layout>