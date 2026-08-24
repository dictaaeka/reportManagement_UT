<x-app-layout>

    <x-slot name="header">
        <div class="data-management-header">
            <div class="reports-header-content flex items-center justify-between gap-6 p-5 sm:p-6">

                <div class="flex items-center gap-4">

                    <div class="data-management-header-icon">
                        <svg
                            class="h-7 w-7"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.7"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0v9L12 21l-8.25-4.5v-9m16.5 0L12 12 3.75 7.5M12 12v9" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="data-management-header-title">
                            Unit Model
                        </h2>

                        <p class="data-management-header-description">
                            Kelola daftar model unit yang digunakan pada laporan.
                        </p>
                    </div>

                </div>

                <a
                    href="{{ route('unit-models.create') }}"
                    class="reports-upload-button">

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    Tambah Unit Model

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
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0v9L12 21l-8.25-4.5v-9m16.5 0L12 12 3.75 7.5M12 12v9" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="data-management-card-title">
                                Daftar Unit Model
                            </h3>

                            <p class="data-management-card-description">
                                Semua model unit yang tersedia dalam sistem.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="data-management-card-body">

                    @if ($unitModels->isEmpty())

                        <div class="data-management-empty-state">

                            <div class="data-management-empty-icon">
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0v9L12 21l-8.25-4.5v-9m16.5 0L12 12 3.75 7.5M12 12v9" />
                                </svg>
                            </div>

                            <p class="data-management-empty-title">
                                Belum ada unit model
                            </p>

                            <p class="data-management-empty-text">
                                Tambahkan unit model pertama untuk digunakan pada laporan.
                            </p>

                        </div>

                    @else

                        <div class="data-management-table-wrapper">

                            <table class="data-management-table">

                                <thead>
                                    <tr>
                                        <th style="text-align: center;">
                                            Nama Unit Model
                                        </th>

                                        <th style="text-align: center;">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($unitModels as $unitModel)

                                        <tr>

                                            <td class="data-management-resource-name">
                                                {{ $unitModel->name }}
                                            </td>

                                            <td style="text-align: center;">

                                                <div class="flex items-center justify-center gap-2">

                                                    <a
                                                        href="{{ route('unit-models.edit', $unitModel) }}"
                                                        class="inline-flex px-3 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium transition hover:bg-indigo-700">
                                                        Edit
                                                    </a>

                                                    <form
                                                        action="{{ route('unit-models.destroy', $unitModel) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Hapus unit model ini?');">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="inline-flex px-3 py-2 rounded-lg bg-red-600 text-white text-sm font-medium transition hover:bg-red-700">
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


                    <div class="mt-4">
                        {{ $unitModels->links() }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>