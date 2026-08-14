<x-app-layout>
    <x-slot name="header">
        <div class="data-management-header">
            <div class="reports-header-content flex items-center justify-between gap-6 p-5 sm:p-6">
                <div class="flex items-center gap-4">
                    <div class="data-management-header-icon">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 10.5-7.5 10.5S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="data-management-header-title">{{ __('Sites') }}</h2>
                        <p class="data-management-header-description">Kelola lokasi situs yang terhubung ke setiap laporan.</p>
                    </div>
                </div>

                <a href="{{ route('sites.create') }}" class="reports-upload-button">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Site
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 10.5-7.5 10.5S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="data-management-card-title">Daftar Site</h3>
                            <p class="data-management-card-description">Semua lokasi kerja yang aktif di aplikasi.</p>
                        </div>
                    </div>
                </div>

                <div class="data-management-card-body">
                    @if ($sites->isEmpty())
                    <div class="data-management-empty-state">
                        <div class="data-management-empty-icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 10.5-7.5 10.5S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <p class="data-management-empty-title">Belum ada site</p>
                        <p class="data-management-empty-text">Tambahkan site baru agar laporan dapat dikelompokkan per lokasi.</p>
                    </div>
                    @else
                    <div class="data-management-table-wrapper">
                        <table class="data-management-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sites as $site)
                                <tr>
                                    <td class="data-management-resource-name">{{ $site->name }}</td>
                                    <td class="data-management-resource-description">{{ $site->location ?: '-' }}</td>
                                    <td>
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('sites.edit', $site) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 transition hover:bg-indigo-100 hover:text-indigo-700" aria-label="Edit site">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652l-9.193 9.193a4.5 4.5 0 01-1.897 1.13l-3.119.936.936-3.119a4.5 4.5 0 011.13-1.897l9.193-9.193z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L16.875 4.5" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('sites.destroy', $site) }}" method="POST" onsubmit="return confirm('Hapus site ini?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100 hover:text-red-700" aria-label="Hapus site">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12m-10 0v10m4-10v10m4-10v10M9 7V4h6v3m-9 0h12" />
                                                    </svg>
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

                    <div class="mt-4">{{ $sites->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>