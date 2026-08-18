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

                    {{-- Title --}}
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

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor">
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
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Card Header -->
                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <span class="flex h-10 w-10 items-center justify-center rounded-lg
                                     bg-indigo-50 text-indigo-600">

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

                        </span>

                        <div>

                            <h3 class="text-base font-semibold text-gray-900">
                                Informasi Laporan
                            </h3>

                            <p class="text-sm text-gray-500 mt-0.5">
                                Lengkapi informasi laporan sebelum mengunggah file.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Form -->
                <form action="{{ route('reports.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="p-6">

                    @csrf


                    <!-- Basic Information -->
                    <div class="grid gap-5 sm:grid-cols-2">

                        <!-- Customer Name -->
                        <div>

                            <label for="customer_id"
                                class="block text-sm font-medium text-gray-700">
                                Nama Customer
                            </label>

                            <select
                                id="customer_id"
                                name="customer_id"
                                class="mt-2 block w-full rounded-lg border-gray-300
                                       shadow-sm text-sm
                                       focus:border-indigo-500 focus:ring-indigo-500"
                                required>

                                <option value="">Pilih Customer</option>

                                @foreach ($customers as $customer)
                                <option
                                    value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->id }}
                                </option>
                                @endforeach
                            </select>

                            @error('customer_id')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>


                        <!-- Issue -->
                        <div>

                            <label for="issue_id"
                                class="block text-sm font-medium text-gray-700">
                                Issue
                            </label>

                            <select
                                id="issue_id"
                                name="issue_id"
                                class="mt-2 block w-full rounded-lg border-gray-300
                                       shadow-sm text-sm
                                       focus:border-indigo-500 focus:ring-indigo-500"
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
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>


                        <!-- Site -->
                        <div>

                            <label for="site_id"
                                class="block text-sm font-medium text-gray-700">
                                Site
                            </label>

                            <select
                                id="site_id"
                                name="site_id"
                                class="mt-2 block w-full rounded-lg border-gray-300
                                       shadow-sm text-sm
                                       focus:border-indigo-500 focus:ring-indigo-500"
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
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>


                        <!-- Period -->
                        <div class="grid grid-cols-2 gap-4">

                            <!-- Month -->
                            <div>

                                <label for="month"
                                    class="block text-sm font-medium text-gray-700">
                                    Bulan
                                </label>

                                <input
                                    id="month"
                                    name="month"
                                    value="{{ old('month') }}"
                                    min="1"
                                    max="12"
                                    placeholder="1–12"
                                    class="mt-2 block w-full rounded-lg border-gray-300
                                           shadow-sm text-sm
                                           focus:border-indigo-500 focus:ring-indigo-500"
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
                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>


                            <!-- Year -->
                            <div>

                                <label for="year"
                                    class="block text-sm font-medium text-gray-700">
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
                                    class="mt-2 block w-full rounded-lg border-gray-300
                                           shadow-sm text-sm
                                           focus:border-indigo-500 focus:ring-indigo-500"
                                    required>

                                @error('year')
                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>

                        </div>

                    </div>


                    <!-- File Upload -->
                    <div class="mt-6">

                        <label for="file"
                            class="block text-sm font-medium text-gray-700">
                            File PDF
                        </label>

                        <div class="mt-2">

                            <label
                                for="file"
                                class="group relative flex flex-col items-center justify-center
                                       w-full min-h-[170px] rounded-xl
                                       border-2 border-dashed border-gray-300
                                       bg-gray-50 px-6 py-8 text-center
                                       cursor-pointer
                                       hover:border-indigo-400
                                       hover:bg-indigo-50/40
                                       transition">

                                <span class="flex h-12 w-12 items-center justify-center
                                             rounded-full bg-indigo-50 text-indigo-600
                                             group-hover:bg-indigo-100">

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

                                <span class="mt-3 text-sm font-semibold text-gray-700">
                                    Pilih file PDF
                                </span>

                                <span class="mt-1 text-xs text-gray-500">
                                    Klik area ini untuk memilih file
                                </span>

                                <span id="file-name"
                                    class="mt-3 text-xs font-medium text-indigo-600">
                                </span>

                                <input
                                    id="file"
                                    type="file"
                                    name="file"
                                    accept="application/pdf"
                                    class="sr-only"
                                    required>

                            </label>

                        </div>

                        <p class="mt-2 text-xs text-gray-500">
                            Format yang diperbolehkan: PDF.
                        </p>

                        @error('file')
                        <p class="mt-1.5 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    <!-- Actions -->
                    <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end
                                border-t border-gray-100 pt-5">

                        <a href="{{ route('reports.index') }}"
                            class="inline-flex items-center justify-center px-4 py-2.5
                                  rounded-lg border border-gray-300
                                  bg-white text-sm font-semibold text-gray-700
                                  hover:bg-gray-50 transition">

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   px-5 py-2.5
                                   bg-indigo-600 border border-transparent
                                   rounded-lg font-semibold text-sm text-white
                                   shadow-sm hover:bg-indigo-700
                                   focus:outline-none focus:ring-2
                                   focus:ring-indigo-500 focus:ring-offset-2
                                   transition">

                            <svg class="h-5 w-5"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15" />

                            </svg>

                            Upload Laporan

                        </button>

                    </div>

                </form>

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