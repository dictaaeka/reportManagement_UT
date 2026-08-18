<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|fraunces:600,700&display=swap" rel="stylesheet" />

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

    <div class="auth-page">
        <div class="auth-shell">

            {{-- ============================================
                 BRAND PANEL
            ============================================= --}}
            <div class="auth-brand-panel">

                <span class="auth-brand-eyebrow">Report Management</span>

                <h1 class="auth-brand-heading">
                    {{ $brandHeading ?? 'Setiap laporan, satu tempat masuk.' }}
                </h1>

                <p class="auth-brand-description">
                    {{ $brandDescription ?? 'Pantau laporan PDF per site, issue, dan periode dalam satu dashboard yang rapi.' }}
                </p>

                <div class="auth-brand-tags">

                    <span class="auth-brand-tag auth-brand-tag-issues">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                        Issues
                    </span>

                    <span class="auth-brand-tag auth-brand-tag-sites">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 10.5-7.5 10.5S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Sites
                    </span>

                    <span class="auth-brand-tag auth-brand-tag-reports">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        Reports
                    </span>

                </div>

                <div class="auth-illustration">

                    <div class="auth-illustration-card auth-illustration-card-back"></div>
                    <div class="auth-illustration-card auth-illustration-card-mid"></div>

                    <div class="auth-illustration-card auth-illustration-card-front">
                        <div class="flex items-center gap-2" style="margin-bottom: 8px;">
                            <div class="auth-illustration-dot"></div>
                            <div class="auth-illustration-line" style="width: 90px;"></div>
                        </div>
                        <div class="auth-illustration-line-sub" style="width: 130px;"></div>
                        <div class="auth-illustration-line-sub" style="width: 100px;"></div>
                    </div>

                </div>

            </div>

            {{-- ============================================
                 FORM PANEL
            ============================================= --}}
            <div class="auth-form-panel">

                <button
                    type="button"
                    id="theme-toggle"
                    class="theme-toggle-button auth-theme-toggle"
                    aria-label="Ganti mode terang / gelap">

                    <svg id="theme-icon-sun" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>

                    <svg id="theme-icon-moon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>

                </button>

                <div class="auth-logo-row">
                    <div class="auth-logo-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <span class="auth-wordmark">Report Management</span>
                </div>

                <h2 class="auth-heading">{{ $title ?? 'Masuk ke akun kamu' }}</h2>
                <p class="auth-subheading">{{ $description ?? 'Kelola laporan dan data operasional' }}</p>

                {{ $slot }}

            </div>

        </div>
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