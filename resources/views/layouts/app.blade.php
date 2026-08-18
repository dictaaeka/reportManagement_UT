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
    <script>
        (function() {
            const theme = localStorage.getItem('theme');

            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen app-page-background">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="app-page-header bg-white shadow">
            <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('theme-toggle');
            const sunIcon = document.getElementById('theme-icon-sun');
            const moonIcon = document.getElementById('theme-icon-moon');

            if (!toggle) return;

            function updateThemeIcon() {
                const isDark = document.documentElement.classList.contains('dark');

                if (isDark) {
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                } else {
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                }
            }

            toggle.addEventListener('click', function() {
                const isDark = document.documentElement.classList.toggle('dark');

                localStorage.setItem(
                    'theme',
                    isDark ? 'dark' : 'light'
                );

                updateThemeIcon();
            });

            updateThemeIcon();
        });
    </script>
</body>

</html>