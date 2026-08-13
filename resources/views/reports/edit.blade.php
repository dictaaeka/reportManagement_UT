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
                            stroke="currentColor"
                            aria-hidden="true">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 16.5V3.75m0 0L7.5 8.25M12 3.75l4.5 4.5M5.25 13.5v4.875A2.625 2.625 0 007.875 21h8.25a2.625 2.625 0 002.625-2.625V13.5" />

                        </svg>

                    </div>


                    {{-- Title --}}
                    <div>

                        <h2 class="reports-header-title">
                            {{ __('Edit Laporan') }}
                        </h2>

                        <p class="reports-header-description">
                            Perbarui informasi laporan PDF yang ada.
                        </p>

                    </div>

                </div>


                {{-- Back --}}
                <a
                    href="{{ route('reports.index') }}"
                    class="reports-back-button">

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
                            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />

                    </svg>

                    Kembali

                </a>

            </div>

        </div>

    </x-slot>


    {{-- CONTENT --}}
    <div class="py-6">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- UPLOAD / EDIT CARD --}}
            <div class="reports-upload-card">

                {{-- CARD HEADER --}}
                <div class="reports-upload-card-header">

                    <div class="reports-upload-card-icon">

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
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 15.89a4.5 4.5 0 01-1.897 1.13L6 18l.98-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z" />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 7.125L16.875 4.5" />

                        </svg>

                    </div>


                    <div>

                        <h3 class="reports-upload-card-title">
                            Edit Informasi Laporan
                        </h3>

                        <p class="reports-upload-card-description">
                            Perbarui informasi laporan dan file PDF jika diperlukan.
                        </p>

                    </div>

                </div>


                {{-- CARD BODY --}}
                <div class="reports-upload-card-body">

                    <form
                        action="{{ route('reports.update', $report) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')


                        {{-- FORM GRID --}}
                        <div class="reports-upload-form-grid">

                            {{-- Nama Customer --}}
                            <div class="reports-upload-field">

                                <label
                                    for="cust_name"
                                    class="reports-upload-label">
                                    Nama Customer
                                </label>

                                <input
                                    id="cust_name"
                                    type="text"
                                    name="cust_name"
                                    value="{{ old('cust_name', $report->cust_name) }}"
                                    placeholder="Masukkan nama customer"
                                    class="reports-upload-input"
                                    required>

                                @error('cust_name')
                                    <p class="reports-upload-error">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Issue --}}
                            <div class="reports-upload-field">

                                <label
                                    for="issue_id"
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
                                            @selected(old('issue_id', $report->issue_id) == $issue->id)>
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


                            {{-- Site --}}
                            <div class="reports-upload-field">

                                <label
                                    for="site_id"
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
                                            @selected(old('site_id', $report->site_id) == $site->id)>
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


                            {{-- Bulan & Tahun --}}
                            <div class="reports-upload-field">

                                <div class="reports-upload-period">

                                    {{-- Bulan --}}
                                    <div>

                                        <label
                                            for="month"
                                            class="reports-upload-label">
                                            Bulan
                                        </label>

                                        <input
                                            id="month"
                                            type="number"
                                            name="month"
                                            value="{{ old('month', $report->month) }}"
                                            min="1"
                                            max="12"
                                            placeholder="1–12"
                                            class="reports-upload-input"
                                            required>

                                        @error('month')
                                            <p class="reports-upload-error">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>


                                    {{-- Tahun --}}
                                    <div>

                                        <label
                                            for="year"
                                            class="reports-upload-label">
                                            Tahun
                                        </label>

                                        <input
                                            id="year"
                                            type="number"
                                            name="year"
                                            value="{{ old('year', $report->year) }}"
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


                        {{-- CURRENT FILE --}}
                        <div class="reports-upload-file-wrapper">

                            <label class="reports-upload-label">
                                File PDF
                            </label>


                            <label
                                for="file"
                                class="reports-upload-file">

                                {{-- Icon --}}
                                <div class="reports-upload-file-icon">

                                    <svg
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.8"
                                        stroke="currentColor"
                                        aria-hidden="true">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 16.5V3.75m0 0L7.5 8.25M12 3.75l4.5 4.5" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5.25 13.5v4.875A2.625 2.625 0 007.875 21h8.25a2.625 2.625 0 002.625-2.625V13.5" />

                                    </svg>

                                </div>


                                {{-- Current File --}}
                                <div class="reports-upload-file-title">
                                    File saat ini
                                </div>

                                <div class="reports-upload-file-name">
                                    {{ $report->file_name }}
                                </div>


                                {{-- New File --}}
                                <div class="reports-upload-file-description">
                                    Klik area ini untuk mengganti file PDF
                                </div>


                                <input
                                    id="file"
                                    type="file"
                                    name="file"
                                    accept="application/pdf"
                                    class="sr-only">


                            </label>


                            @error('file')
                                <p class="reports-upload-error">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- ACTIONS --}}
                        <div class="reports-upload-actions">

                            <a
                                href="{{ route('reports.index') }}"
                                class="reports-cancel-button">

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="reports-submit-button">

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
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 15.89a4.5 4.5 0 01-1.897 1.13L6 18l.98-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z" />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19.5 7.125L16.875 4.5" />

                                </svg>

                                Simpan Perubahan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>