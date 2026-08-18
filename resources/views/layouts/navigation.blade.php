<nav x-data="{ open: false }" class="app-navbar bg-white border-b border-gray-200 shadow-sm">
    <!-- Primary Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-[auto_1fr_auto] items-center h-[72px]">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('reports.index') }}"
                    class="flex items-center transition-opacity hover:opacity-80">

                    <x-application-logo class="block h-9 w-auto fill-current app-logo" />

                </a>
            </div>


            <!-- Desktop Navigation -->
            <div class="hidden sm:flex items-center justify-center gap-2">

                @if (Auth::user()->isAdmin())
                <!-- Reports -->
                <a href="{{ route('reports.index') }}"
                    class="group inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition
                   {{ request()->routeIs('reports.*')
                        ? 'bg-indigo-50 text-indigo-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                    <svg class="h-[18px] w-[18px] transition
                        {{ request()->routeIs('reports.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        aria-hidden="true">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                    </svg>

                    <span>Reports</span>

                </a>


                @endif

                @if (Auth::user()->isAdmin())
                <!-- Issues -->
                <a href="{{ route('issues.index') }}"
                    class="group inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition
                       {{ request()->routeIs('issues.*')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                    <svg class="h-[18px] w-[18px] transition
                            {{ request()->routeIs('issues.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        aria-hidden="true">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />

                    </svg>

                    <span>Issues</span>

                </a>


                <!-- Sites -->
                <a href="{{ route('sites.index') }}"
                    class="group inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition
                       {{ request()->routeIs('sites.*')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                    <svg class="h-[18px] w-[18px] transition
                            {{ request()->routeIs('sites.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        aria-hidden="true">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />

                    </svg>

                    <span>Sites</span>

                </a>

                <!-- Customers -->
                <a href="{{ route('customers.index') }}"
                    class="group inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium transition
        {{ request()->routeIs('customers.*')
            ? 'bg-indigo-50 text-indigo-700'
            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">

                    <svg class="h-[18px] w-[18px] transition
            {{ request()->routeIs('customers.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        aria-hidden="true">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1" />

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 20H4v-2a4 4 0 014-4h1" />

                        <circle cx="9" cy="7" r="4" />

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 3.5a4 4 0 010 7" />
                    </svg>

                    <span>Customers</span>
                </a>
                @endif

            </div>


            <!-- Desktop Right Area -->
            <div class="hidden sm:flex items-center justify-end gap-3">

                <!-- =====================================================
                     THEME
                      ===================================================== -->

                <button
                    type="button"
                    id="theme-toggle"
                    class="theme-toggle-button"
                    aria-label="Toggle dark mode">
                    <svg id="theme-icon-sun" class="hidden w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364-.707.707M6.343 17.657l-.707.707m12.728 0-.707-.707M6.343 6.343l-.707-.707M12 7a5 5 0 100 10 5 5 0 000-10z" />
                    </svg>

                    <svg id="theme-icon-moon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>
                </button>

                <!-- =====================================================
                     NOTIFICATION
                     ===================================================== -->

                <div
                    x-data="{ notificationOpen: false }"
                    class="relative">

                    <!-- Notification Button -->
                    <button
                        type="button"
                        @click="notificationOpen = ! notificationOpen"
                        @click.outside="notificationOpen = false"
                        class="relative inline-flex items-center justify-center
                               w-10 h-10 rounded-lg
                               text-gray-500 hover:text-gray-700
                               hover:bg-gray-50
                               focus:outline-none
                               transition"
                        aria-label="Notifications">

                        <!-- Bell Icon -->
                        <svg
                            class="h-[21px] w-[21px]"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 10-12 0v.75c0 2.13-.74 4.09-1.977 5.638a23.848 23.848 0 005.454 1.31m5.38 0a24.255 24.255 0 01-5.38 0m5.38 0a3 3 0 11-5.38 0" />

                        </svg>


                        <!-- Unread Badge -->
                        @if (Auth::user()->unreadNotifications->count() > 0)

                        <span
                            class="absolute -top-0.5 -right-0.5
                                       min-w-[18px] h-[18px]
                                       px-1
                                       flex items-center justify-center
                                       rounded-full
                                       bg-red-500
                                       text-white
                                       text-[10px]
                                       font-bold
                                       border-2 border-white">
                            {{ Auth::user()->unreadNotifications->count() > 99
                                    ? '99+'
                                    : Auth::user()->unreadNotifications->count() }}
                        </span>

                        @endif

                    </button>


                    <!-- Notification Dropdown -->
                    <div
                        x-show="notificationOpen"
                        x-transition
                        style="display: none;"
                        @click.outside="notificationOpen = false"
                        class="notification-dropdown absolute right-0 mt-3 w-[380px] bg-white rounded-2xl border border-gray-200 shadow-xl z-50 overflow-hidden">

                        <!-- Header -->
                        <div class="notification-header flex items-center justify-between px-5 py-4">

                            <div>
                                <h3 class="notification-title text-sm font-semibold">
                                    Notifikasi
                                </h3>

                                <p class="notification-subtitle text-xs mt-0.5">
                                    Aktivitas terbaru
                                </p>
                            </div>


                            @if (Auth::user()->unreadNotifications->count() > 0)

                            <form
                                method="POST"
                                action="{{ route('notifications.readAll') }}">

                                @csrf

                                <button
                                    type="submit"
                                    class="text-xs font-medium
                                               text-indigo-600
                                               hover:text-indigo-700
                                               transition">
                                    Tandai semua dibaca
                                </button>

                            </form>

                            @endif

                        </div>


                        <!-- Notification List -->
                        <div class="max-h-[430px] overflow-y-auto">

                            @forelse (
                            Auth::user()->notifications()->latest()->limit(20)->get()
                            as $notification
                            )

                            @php
                            $data = $notification->data;

                            $type = $data['type'] ?? 'system';
                            $message = $data['message'] ?? 'Notifikasi baru';
                            $detail = $data['detail'] ?? null;

                            $isUnread = is_null($notification->read_at);
                            @endphp


                            <form
                                method="POST"
                                action="{{ route('notifications.read', $notification->id) }}">

                                @csrf

                                <button
                                    type="submit"
                                    class="notification-item w-full text-left
                                            px-5 py-4
                                            transition
                                            {{ $isUnread ? 'notification-unread' : '' }}">

                                    <div class="flex items-start gap-3">

                                        <!-- Notification Icon -->
                                        <div
                                            class="flex-shrink-0
                                                       w-9 h-9
                                                       rounded-full
                                                       flex items-center justify-center
                                                       {{ match($type) { 
                                                            'login_success'
                                                                => 'bg-emerald-50 text-emerald-600',

                                                            'download_report'
                                                                => 'bg-purple-50 text-purple-600',

                                                            'new_report_available',
                                                            'add_report',
                                                            'add_issue',
                                                            'add_site',
                                                            'add_customer'
                                                                => 'bg-indigo-50 text-indigo-600',

                                                            'report_updated',
                                                            'edit_report',
                                                            'edit_issue',
                                                            'edit_site',
                                                            'edit_customer'
                                                                => 'bg-blue-50 text-blue-600',

                                                            'report_deleted',
                                                            'delete_report',
                                                            'delete_issue',
                                                            'delete_site',
                                                            'delete_customer'
                                                                => 'bg-red-50 text-red-600',

                                                            default
                                                                => 'bg-gray-100 text-gray-500',

                                                            } }}">


                                            @if (
                                            in_array($type,
                                            [
                                            'login_success',
                                            'new_report_available',
                                            'add_report',
                                            'add_issue',
                                            'add_site',
                                            'add_customer'
                                            ]
                                            )
                                            )

                                            <!-- Plus / Login -->
                                            <svg
                                                class="w-4 h-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="2"
                                                stroke="currentColor">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>

                                            @elseif (
                                            in_array(
                                            $type,
                                            ['report_updated', 'edit_report']
                                            )
                                            )

                                            <!-- Edit -->
                                            <svg
                                                class="w-4 h-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="2"
                                                stroke="currentColor">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652l-9.193 9.193a4.5 4.5 0 01-1.897 1.13l-3.119.936.936-3.119a4.5 4.5 0 011.13-1.897l9.193-9.193z" />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M19.5 7.125L16.875 4.5" />
                                            </svg>

                                            @elseif (
                                            in_array(
                                            $type,
                                            [ 'report_deleted',
                                            'delete_report',
                                            'delete_issue',
                                            'delete_site',
                                            'delete_customer']
                                            )
                                            )

                                            <!-- Delete -->
                                            <svg
                                                class="w-4 h-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="2"
                                                stroke="currentColor">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M6 7h12m-10 0v10m4-10v10m4-10v10M9 7V4h6v3m-9 0h12" />
                                            </svg>

                                            @else

                                            <!-- Bell -->
                                            <svg
                                                class="w-4 h-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.8"
                                                stroke="currentColor">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 10-12 0v.75c0 2.13-.74 4.09-1.977 5.638a23.848 23.848 0 005.454 1.31m5.38 0a24.255 24.255 0 01-5.38 0m5.38 0a3 3 0 11-5.38 0" />
                                            </svg>

                                            @endif

                                        </div>


                                        <!-- Content -->
                                        <div class="min-w-0 flex-1">

                                            <div class="flex items-start justify-between gap-2">

                                                <p class="notification-message text-sm
                                                        {{ $isUnread ? 'font-semibold' : 'font-medium' }}">

                                                @if ($isUnread)

                                                <span
                                                    class="flex-shrink-0
                                                                   w-2 h-2
                                                                   mt-1.5
                                                                   rounded-full
                                                                   bg-indigo-500"></span>

                                                @endif

                                            </div>


                                            @if ($detail)

                                            <p class="notification-detail mt-1 text-xs truncate">
                                                {{ $detail }}
                                            </p>

                                            @endif


                                            <p class="notification-time js-local-time mt-1.5 text-[11px]" data-timestamp="{{ $notification->created_at->toIso8601String() }}">
                                                {{ $notification->created_at->format('d M Y • H:i') }}
                                            </p>

                                        </div>

                                    </div>

                                </button>

                            </form>

                            @empty

                            <div class="px-6 py-10 text-center">

                                <div
                                    class="mx-auto mb-3
                                               w-11 h-11
                                               rounded-full
                                               bg-gray-100
                                               text-gray-400
                                               flex items-center justify-center">

                                    <svg
                                        class="w-5 h-5"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.8"
                                        stroke="currentColor">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 10-12 0v.75c0 2.13-.74 4.09-1.977 5.638a23.848 23.848 0 005.454 1.31m5.38 0a24.255 24.255 0 01-5.38 0m5.38 0a3 3 0 11-5.38 0" />

                                    </svg>

                                </div>

                                <p class="text-sm font-medium text-gray-600">
                                    Belum ada notifikasi
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    Aktivitas terbaru akan muncul di sini.
                                </p>

                            </div>

                            @endforelse

                        </div>

                    </div>

                </div>


                <!-- =====================================================
                     USER MENU
                     ===================================================== -->

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="user-menu-button inline-flex items-center gap-2.5 px-2 py-1.5 rounded-lg text-sm font-medium focus:outline-none transition">

                            <span
                                class="flex h-9 w-9 items-center justify-center rounded-full
                                       bg-indigo-50 text-indigo-600">

                                <svg
                                    class="h-[18px] w-[18px]"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    aria-hidden="true">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0
                                           3.75 3.75 0 017.5 0z
                                           M4.501 20.118a7.5 7.5 0
                                           0114.998 0A17.933 17.933
                                           0 0112 21.75c-2.676 0
                                           -5.216-.584-7.499-1.632z" />

                                </svg>

                            </span>


                            <span class="hidden lg:block text-left leading-tight">

                                <span class="user-menu-name block text-sm font-medium">
                                    {{ Auth::user()->name }}
                                </span>

                            </span>


                            <svg
                                class="h-4 w-4 text-gray-400"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor">

                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />

                            </svg>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            <!-- Mobile Menu Button -->
            <div class="flex sm:hidden items-center justify-end">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-lg
                           text-gray-500 hover:text-gray-700 hover:bg-gray-100
                           focus:outline-none transition">

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24">

                        <path
                            :class="{'hidden': open, 'inline-flex': ! open}"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open}"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    <!-- Mobile Navigation -->
    <div
        :class="{'block': open, 'hidden': ! open}"
        class="mobile-navigation hidden sm:hidden border-t border-gray-100 bg-white">

        <div class="px-4 pt-3 pb-3 space-y-1">

            <a
                href="{{ route('reports.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium
                {{ request()->routeIs('reports.*')
                    ? 'bg-indigo-50 text-indigo-700'
                    : 'text-gray-600 hover:bg-gray-50' }}">
                <span>Reports</span>
            </a>


            @if (Auth::user()->isAdmin())
            <a
                href="{{ route('issues.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium
                    {{ request()->routeIs('issues.*')
                        ? 'bg-indigo-50 text-indigo-700'
                        : 'text-gray-600 hover:bg-gray-50' }}">
                <span>Issues</span>
            </a>


            <a
                href="{{ route('sites.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium
                    {{ request()->routeIs('sites.*')
                        ? 'bg-indigo-50 text-indigo-700'
                        : 'text-gray-600 hover:bg-gray-50' }}">
                <span>Sites</span>
            </a>

            <a
                href="{{ route('customers.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium
                    {{ request()->routeIs('customers.*')
                    ? 'bg-indigo-50 text-indigo-700'
                    : 'text-gray-600 hover:bg-gray-50' }}">
                <span>Customers</span>
            </a>
            @endif

        </div>


        <div class="border-t border-gray-100 px-4 py-4">

            <div class="flex items-center gap-3 mb-3">

                <span
                    class="flex h-9 w-9 items-center justify-center rounded-full
                           bg-indigo-50 text-indigo-600">

                    <svg
                        class="h-5 w-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0
                               3.75 3.75 0 017.5 0z
                               M4.501 20.118a7.5 7.5 0
                               0114.998 0A17.933 17.933
                               0 0112 21.75c-2.676 0
                               -5.216-.584-7.499-1.632z" />

                    </svg>

                </span>


                <div>

                    <div class="font-medium text-sm text-gray-800">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-xs text-gray-500">
                        {{ Auth::user()->email }}
                    </div>

                </div>

            </div>


            <div class="space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>


                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.js-local-time').forEach(function(element) {
                const value = element.dataset.timestamp;
                if (!value) return;

                const date = new Date(value);
                if (Number.isNaN(date.getTime())) return;

                const formatted = new Intl.DateTimeFormat(undefined, {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false,
                }).format(date);

                element.textContent = formatted.replace(',', ' •');
            });
        });
    </script>

</nav>