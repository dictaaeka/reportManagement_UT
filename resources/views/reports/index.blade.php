<x-app-layout>

    {{-- =====================================================
        HEADER
    ====================================================== --}}
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
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>

                    </div>


                    {{-- Title --}}
                    <div>

                        <h2 class="reports-header-title">
                            {{ __('Reports') }}
                        </h2>

                        <p class="reports-header-description">
                            Kelola laporan PDF berdasarkan issue, site, bulan, dan tahun.
                        </p>

                    </div>

                </div>


                {{-- Upload --}}
                <a
                    href="{{ route('reports.create') }}"
                    class="reports-upload-button">

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

                    Upload Laporan

                </a>

            </div>

        </div>

    </x-slot>


    {{-- =====================================================
        PAGE CONTENT
    ====================================================== --}}
    <div class="reports-page py-6">

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
                STATISTICS
            ================================================= --}}
            <div class="report-stats-grid">


                {{-- TOTAL ISSUES --}}
                <div class="report-stat-card">

                    <div class="report-stat-icon report-stat-icon-issues">

                        <svg
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m0 3.75h.007M10.34 3.94l-7.04 12.18A1.875 1.875 0 004.925 19h14.15a1.875 1.875 0 001.624-2.88L13.66 3.94a1.875 1.875 0 00-3.32 0z" />
                        </svg>

                    </div>


                    <div class="report-stat-content">

                        <p class="report-stat-label">
                            Total Issues
                        </p>

                        <p class="report-stat-number">
                            {{ number_format($issueCount) }}
                        </p>

                    </div>


                    <div class="report-stat-decoration report-stat-decoration-issues"></div>

                </div>



                {{-- TOTAL SITES --}}
                <div class="report-stat-card">

                    <div class="report-stat-icon report-stat-icon-sites">

                        <svg
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 10.5-7.5 10.5S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>

                    </div>


                    <div class="report-stat-content">

                        <p class="report-stat-label">
                            Total Sites
                        </p>

                        <p class="report-stat-number">
                            {{ number_format($siteCount) }}
                        </p>

                    </div>


                    <div class="report-stat-decoration report-stat-decoration-sites"></div>

                </div>



                {{-- TOTAL REPORTS --}}
                <div class="report-stat-card">

                    <div class="report-stat-icon report-stat-icon-reports">

                        <svg
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>

                    </div>


                    <div class="report-stat-content">

                        <p class="report-stat-label">
                            Total Reports
                        </p>

                        <p class="report-stat-number">
                            {{ number_format($reportCount) }}
                        </p>

                    </div>


                    <div class="report-stat-decoration report-stat-decoration-reports"></div>

                </div>

            </div>


            {{-- =================================================
                RECENT REPORTS
            ================================================== --}}
            <div class="recent-reports-card">


                {{-- HEADER --}}
                <div class="recent-reports-header">

                    <div class="recent-reports-title-wrapper">

                        <div class="recent-reports-icon">

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
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>

                        </div>


                        <div>

                            <h3 class="recent-reports-title">
                                Laporan Terbaru
                            </h3>

                            <p class="recent-reports-subtitle">
                                Daftar laporan yang tersedia
                            </p>

                        </div>

                    </div>


                    <span class="recent-reports-count">
                        {{ number_format($reportCount) }} laporan
                    </span>

                </div>



                @if ($latestReports->isEmpty())

                {{-- EMPTY STATE --}}
                <div class="reports-empty-state">

                    <div class="reports-empty-icon">

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.6"
                            stroke="currentColor"
                            aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12" />
                        </svg>

                    </div>

                    <p class="reports-empty-text">
                        Belum ada laporan yang diunggah.
                    </p>

                </div>

                @else


                {{-- =================================================
                        FILTER
                    ================================================== --}}
                <div class="reports-filter-area">

                    <form
                        method="GET"
                        action="{{ route('reports.index') }}"
                        class="reports-filter-grid grid gap-4 lg:grid-cols-5">


                        {{-- ISSUE --}}
                        <div>

                            <label class="reports-filter-label">
                                Issue
                            </label>

                            <select
                                name="issue"
                                onchange="this.form.submit()"
                                class="reports-filter-select">

                                <option value="">
                                    Semua issue
                                </option>

                                @foreach ($issues as $issue)

                                <option
                                    value="{{ $issue->id }}"
                                    @selected(request('issue')==$issue->id)
                                    >
                                    {{ $issue->name }}
                                </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- SITE --}}
                        <div>

                            <label class="reports-filter-label">
                                Site
                            </label>

                            <select
                                name="site"
                                class="reports-filter-select">

                                <option value="">
                                    Semua site
                                </option>

                                @foreach ($sites as $site)

                                <option
                                    value="{{ $site->id }}"
                                    @selected(request('site')==$site->id)
                                    >
                                    {{ $site->name }}
                                </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- BULAN --}}
                        <div>

                            <label class="reports-filter-label">
                                Bulan
                            </label>

                            <select
                                name="month"
                                class="reports-filter-select">

                                <option value="">
                                    Semua bulan
                                </option>

                                @foreach (\App\Models\Report::monthNames() as $number => $name)

                                <option
                                    value="{{ $number }}"
                                    @selected(request('month')==$number)>
                                    {{ $name }}
                                </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- TAHUN --}}
                        <div>

                            <label class="reports-filter-label">
                                Tahun
                            </label>

                            <input
                                type="number"
                                name="year"
                                value="{{ request('year') }}"
                                min="1900"
                                max="2100"
                                placeholder="2026"
                                class="reports-filter-input">

                        </div>


                        {{-- SEARCH + FILTER --}}
                        <div>

                            <label class="reports-filter-label">
                                Cari laporan
                            </label>

                            <div class="flex gap-2">

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Masukkan Customer..."
                                    class="reports-filter-input min-w-0">

                                <button
                                    type="submit"
                                    class="reports-filter-button">
                                    Filter
                                </button>

                            </div>

                        </div>

                    </form>

                </div>



                {{-- =================================================
                        TABLE
                    ================================================== --}}
                <div class="reports-table-wrapper">

                    <table class="reports-table">

                        <thead>

                            <tr>

                                <th>
                                    Nama Customer
                                </th>

                                <th>
                                    Issue / Site
                                </th>

                                <th>
                                    Periode
                                </th>

                                <th>
                                    Uploader
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($reports as $report)

                            <tr>

                                {{-- TITLE --}}
                                <td>

                                    <span class="report-title">
                                        {{ $report->cust_name }}
                                    </span>

                                </td>


                                {{-- ISSUE / SITE --}}
                                <td>

                                    <span class="report-issue-site">
                                        {{ $report->issue->name ?? '—' }}
                                        /
                                        {{ $report->site->name ?? '—' }}
                                    </span>

                                </td>


                                {{-- PERIOD --}}
                                <td>

                                    <span class="report-period-badge">
                                        {{ $report->monthName() }}
                                        {{ $report->year }}
                                    </span>

                                </td>


                                {{-- UPLOADER --}}
                                <td>

                                    <span class="report-uploader">
                                        {{ $report->uploader->name ?? '—' }}
                                    </span>

                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <div class="report-actions">


                                        {{-- VIEW --}}
                                        <a
                                            href="{{ route('reports.preview', $report) }}"
                                            target="_blank"
                                            title="Lihat PDF"
                                            aria-label="Lihat PDF"
                                            class="report-action-button report-action-view">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.8"
                                                stroke="currentColor"
                                                aria-hidden="true">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>

                                        </a>


                                        {{-- DOWNLOAD --}}
                                        <a
                                            href="{{ route('reports.download', $report) }}"
                                            title="Download PDF"
                                            aria-label="Download PDF"
                                            class="report-action-button report-action-download">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.8"
                                                stroke="currentColor"
                                                aria-hidden="true">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>

                                        </a>


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('reports.edit', $report) }}"
                                            title="Edit"
                                            aria-label="Edit laporan"
                                            class="report-action-button report-action-edit">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.8"
                                                stroke="currentColor"
                                                aria-hidden="true">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z" />
                                            </svg>

                                        </a>


                                        {{-- DELETE --}}
                                        <form
                                            action="{{ route('reports.destroy', $report) }}"
                                            method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Hapus laporan ini?');">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Hapus"
                                                aria-label="Hapus laporan"
                                                class="report-action-button report-action-delete">

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    aria-hidden="true">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-8 text-center text-sm text-gray-500">
                                    Tidak ada laporan.
                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}
                <div class="reports-pagination">

                    {{ $reports->links() }}

                </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>