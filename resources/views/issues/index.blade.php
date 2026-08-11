<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Issues') }}</h2>
            <a href="{{ route('issues.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Tambah Issue</a>
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

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($issues as $issue)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $issue->name }}</td>
                                <td class="px-6 py-4 whitespace-normal text-sm text-gray-600">{{ $issue->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('issues.edit', $issue) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('issues.destroy', $issue) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus issue ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-3 text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada issue.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">{{ $issues->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>