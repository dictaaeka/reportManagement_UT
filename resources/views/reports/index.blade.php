<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Reports') }}</h2>
                <p class="text-sm text-gray-600">Kelola laporan PDF berdasarkan issue, site, bulan, dan tahun.</p>
            </div>
            <a href="{{ route('reports.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">Upload Laporan</a>
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

            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">
                <form method="GET" action="{{ route('reports.index') }}" class="grid gap-4 lg:grid-cols-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Issue</label>
                        <select name="issue" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua issue</option>
                            @foreach ($issues as $issue)
                            <option value="{{ $issue->id }}" @selected(request('issue')==$issue->id)>{{ $issue->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <input type="number" name="month" value="{{ request('month') }}" min="1" max="12" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="1-12">
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
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $report->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $report->issue->name ?? '—' }} / {{ $report->site->name ?? '—' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $report->month }}/{{ $report->year }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $report->uploader->name ?? '—' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('reports.preview', $report) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Preview</a>
                                    <a href="{{ route('reports.download', $report) }}" class="text-green-600 hover:text-green-900">Download</a>
                                    <a href="{{ route('reports.edit', $report) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                    <form action="{{ route('reports.destroy', $report) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus laporan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
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