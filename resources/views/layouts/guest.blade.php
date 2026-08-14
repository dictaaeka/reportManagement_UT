<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-slate-100 px-4 py-8">
        <div class="mb-6">
            <a href="/" class="inline-flex items-center justify-center rounded-2xl border border-indigo-100 bg-white p-3 shadow-sm transition hover:shadow-md">
                <x-application-logo class="h-16 w-16 fill-current text-indigo-600" />
            </a>
        </div>

        <div class="w-full sm:max-w-md overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_10px_30px_rgba(15,23,42,0.06)]">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zm-9.249 13.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold text-slate-900">Masuk ke Report Management</h1>
                        <p class="text-xs text-slate-500">Kelola laporan dan data operasional</p>
                    </div>
                </div>
            </div>

            <div class="px-6 py-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>