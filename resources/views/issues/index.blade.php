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
                        <h2 class="data-management-header-title">{{ __('Issues') }}</h2>
                        <p class="data-management-header-description">Kelola daftar issue yang digunakan pada seluruh laporan.</p>
                    </div>
                </div>

                <a href="{{ route('issues.create') }}" class="reports-upload-button">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Issue
                </a>
            </div>
        </div>
    </x-slot>

    <div class="reports-page py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-5 rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-5 rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
            @endif

            <div class="data-management-card">
                <div class="data-management-card-header">
                    <div class="data-management-card-header-inner">
                        <div class="data-management-card-icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="data-management-card-title">Daftar Issue</h3>
                            <p class="data-management-card-description">Issue aktif dan data yang tersedia dalam sistem.</p>
                        </div>
                    </div>
                </div>

                <div class="data-management-card-body">
                    @if ($issues->isEmpty())
                    <div class="data-management-empty-state">
                        <div class="data-management-empty-icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                        </div>
                        <p class="data-management-empty-title">Belum ada issue</p>
                        <p class="data-management-empty-text">Tambahkan issue pertama untuk mulai mengelola laporan.</p>
                    </div>
                    @else
                    <div class="data-management-table-wrapper">
                        <table class="data-management-table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Nama</th>
                                    <th style="text-align: center;">Deskripsi</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($issues as $issue)
                                <tr>
                                    <td class="data-management-resource-name">{{ $issue->name }}</td>
                                    <td class="data-management-resource-description">{{ $issue->description ?: '-' }}</td>
                                    <td style="text-align: center;">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('issues.edit', $issue) }}" class="inline-flex px-3 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium transition hover:bg-indigo-700" aria-label="Edit issue">
                                                Edit
                                            </a>

                                            <form action="{{ route('issues.destroy', $issue) }}" method="POST" onsubmit="return confirm('Hapus issue ini?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="inline-flex px-3 py-2 rounded-lg bg-red-600 text-white text-sm font-medium transition hover:bg-red-700" aria-label="Hapus issue">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <div class="mt-4">{{ $issues->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>