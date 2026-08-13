<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-indigo-50 to-white">
            <div class="flex flex-col gap-4 p-4 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                <div class="flex items-start gap-4">
                    <span class="hidden sm:flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </span>
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Reports') }}</h2>
                        <p class="text-sm text-gray-600 mt-1">Kelola laporan PDF berdasarkan issue, site, bulan, dan tahun.</p>
                    </div>
                </div>
                <a href="{{ route('reports.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-white shadow-sm hover:bg-indigo-700 transition">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Upload Laporan
                </a>
            </div>

            <!-- Ilustrasi dekoratif, non-mengganggu, hanya tampil di layar besar -->
            <svg class="pointer-events-none absolute -right-6 -bottom-10 hidden lg:block h-40 w-40 text-indigo-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.7" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-800">{{ session('error') }}</div>
            @endif

            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="rounded-lg bg-white p-4 sm:p-6 shadow-sm">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Total Issues</p>
                    <p class="mt-2 sm:mt-4 text-xl sm:text-3xl font-semibold text-gray-900">{{ number_format($issueCount) }}</p>
                </div>
                <div class="rounded-lg bg-white p-4 sm:p-6 shadow-sm">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Total Sites</p>
                    <p class="mt-2 sm:mt-4 text-xl sm:text-3xl font-semibold text-gray-900">{{ number_format($siteCount) }}</p>
                </div>
                <div class="rounded-lg bg-white p-4 sm:p-6 shadow-sm">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Total Reports</p>
                    <p class="mt-2 sm:mt-4 text-xl sm:text-3xl font-semibold text-gray-900">{{ number_format($reportCount) }}</p>
                </div>
            </div>

            <!-- Laporan Terbaru: sekarang berbentuk tabel ringkas (bukan card lagi) -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex flex-col gap-1 mb-4 sm:flex-row sm:items-center sm:justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Laporan Terbaru</h3>
                    <p class="text-xs text-gray-400">Issue · Site · Bulan · Tahun</p>
                </div>

                @if ($latestReports->isEmpty())
                <p class="text-sm text-gray-500">Belum ada laporan yang diunggah.</p>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issue</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Site</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($latestReports as $latest)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $latest->title }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $latest->issue->name ?? '—' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $latest->site->name ?? '—' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $latest->monthName() }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $latest->year }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">
                <form method="GET" action="{{ route('reports.index') }}" class="grid gap-4 lg:grid-cols-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Issue</label>
                        <select name="issue" onchange="this.form.submit()" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua issue</option>
                            @foreach ($issues as $issue)
                            <option value="{{ $issue->id }}" @selected(request('issue')==$issue->id)>{{ $issue->name }}</option>
                            @endforeach
                        </select>                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Site</label>
                        <select name="site" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua site</option>
                            @foreach ($sites as $site)
                            <option value="{{ $site->id }}" @selected(request('site')==$site->id)>{{ $site->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select name="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua bulan</option>
                            @foreach (\App\Models\Report::monthNames() as $number => $name)
                            <option value="{{ $number }}" @selected(request('month')==$number)>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tahun</label>
                        <input type="number" name="year" value="{{ request('year') }}" min="1900" max="2100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="2026">
                    </div>
                    <div class="flex items-end gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Cari laporan...">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">Filter</button>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issue / Site</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploader</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($reports as $report)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $report->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $report->issue->name ?? '—' }} / {{ $report->site->name ?? '—' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $report->monthName() }} {{ $report->year }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $report->uploader->name ?? '—' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('reports.preview', $report) }}" target="_blank" title="Lihat PDF" class="text-indigo-600 hover:text-indigo-900">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('reports.download', $report) }}" title="Download PDF" class="text-green-600 hover:text-green-900">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('reports.edit', $report) }}" title="Edit" class="text-blue-600 hover:text-blue-900">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('reports.destroy', $report) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus laporan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus" class="text-red-600 hover:text-red-900">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada laporan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $reports->links() }}</div>
            </div>
        </div>
    </div>

</x-app-layout>