<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Total Issues</p>
                    <p class="mt-4 text-3xl font-semibold text-gray-900">{{ number_format($issueCount) }}</p>
                </div>
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Total Sites</p>
                    <p class="mt-4 text-3xl font-semibold text-gray-900">{{ number_format($siteCount) }}</p>
                </div>
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Total Reports</p>
                    <p class="mt-4 text-3xl font-semibold text-gray-900">{{ number_format($reportCount) }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Laporan Terbaru</h3>
                    <a href="{{ route('reports.index') }}" class="text-indigo-600 hover:text-indigo-900">Lihat semua laporan</a>
                </div>
                <div class="space-y-4">
                    @forelse ($latestReports as $report)
                    <div class="rounded-lg border border-gray-200 p-4">
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $report->customer?->name ?? '—' }}</p>
                                <p class="text-sm text-gray-600">{{ $report->issue->name ?? '—' }} / {{ $report->site->name ?? '—' }}</p>
                            </div>
                            <p class="text-sm text-gray-500">{{ $report->month }}/{{ $report->year }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-500">Belum ada laporan yang diunggah.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>