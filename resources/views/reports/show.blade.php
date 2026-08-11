<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Detail Laporan') }}</h2>
            <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">Kembali</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Judul</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $report->title }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Issue</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $report->issue->name ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Site</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $report->site->name ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Periode</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $report->month }}/{{ $report->year }}</p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Uploader</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $report->uploader->name ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">File</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $report->file_name }}</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('reports.preview', $report) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">Preview PDF</a>
                    <a href="{{ route('reports.download', $report) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700">Download PDF</a>
                    <a href="{{ route('reports.edit', $report) }}" class="inline-flex items-center px-4 py-2 bg-slate-600 border border-transparent rounded-md font-semibold text-white hover:bg-slate-700">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>