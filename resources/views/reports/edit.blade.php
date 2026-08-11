<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Laporan') }}</h2>
            <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">Kembali</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('reports.update', $report) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Judul Laporan</label>
                            <input type="text" name="title" value="{{ old('title', $report->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Issue</label>
                            <select name="issue_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Pilih issue</option>
                                @foreach ($issues as $issue)
                                <option value="{{ $issue->id }}" @selected(old('issue_id', $report->issue_id) == $issue->id)>{{ $issue->name }}</option>
                                @endforeach
                            </select>
                            @error('issue_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Site</label>
                            <select name="site_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Pilih site</option>
                                @foreach ($sites as $site)
                                <option value="{{ $site->id }}" @selected(old('site_id', $report->site_id) == $site->id)>{{ $site->name }}</option>
                                @endforeach
                            </select>
                            @error('site_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bulan</label>
                                <input type="number" name="month" value="{{ old('month', $report->month) }}" min="1" max="12" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('month') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                                <input type="number" name="year" value="{{ old('year', $report->year) }}" min="1900" max="2100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('year') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm text-gray-600">File saat ini: <strong>{{ $report->file_name }}</strong></p>
                        <label class="block text-sm font-medium text-gray-700 mt-3">Ganti File PDF (opsional)</label>
                        <input type="file" name="file" accept="application/pdf" class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="mt-6 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>