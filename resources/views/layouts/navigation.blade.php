<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">

    <!-- Primary Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-[auto_1fr_auto] items-center h-[72px]">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('reports.index') }}"
                   class="flex items-center transition-opacity hover:opacity-80">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex items-center justify-center gap-2">

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

            </div>

            <!-- User Menu -->
            <div class="hidden sm:flex items-center justify-end">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center gap-2.5 px-2 py-1.5 rounded-lg text-sm font-medium
                                   text-gray-600 hover:bg-gray-50 hover:text-gray-900
                                   focus:outline-none transition">

                            <span class="flex h-9 w-9 items-center justify-center rounded-full
                                         bg-indigo-50 text-indigo-600">

                                <svg class="h-[18px] w-[18px]"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.8"
                                     stroke="currentColor"
                                     aria-hidden="true">

                                    <path stroke-linecap="round"
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
                                <span class="block text-sm font-medium text-gray-700">
                                    {{ Auth::user()->name }}
                                </span>
                            </span>

                            <svg class="h-4 w-4 text-gray-400"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">

                                <path fill-rule="evenodd"
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

                    <svg class="h-6 w-6"
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
        class="hidden sm:hidden border-t border-gray-100 bg-white">

        <div class="px-4 pt-3 pb-3 space-y-1">

            <a href="{{ route('reports.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium
               {{ request()->routeIs('reports.*')
                    ? 'bg-indigo-50 text-indigo-700'
                    : 'text-gray-600 hover:bg-gray-50' }}">

                <span>Reports</span>
            </a>

            <a href="{{ route('issues.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium
               {{ request()->routeIs('issues.*')
                    ? 'bg-indigo-50 text-indigo-700'
                    : 'text-gray-600 hover:bg-gray-50' }}">

                <span>Issues</span>
            </a>

            <a href="{{ route('sites.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium
               {{ request()->routeIs('sites.*')
                    ? 'bg-indigo-50 text-indigo-700'
                    : 'text-gray-600 hover:bg-gray-50' }}">

                <span>Sites</span>
            </a>

        </div>

        <div class="border-t border-gray-100 px-4 py-4">

            <div class="flex items-center gap-3 mb-3">

                <span class="flex h-9 w-9 items-center justify-center rounded-full
                             bg-indigo-50 text-indigo-600">

                    <svg class="h-5 w-5"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.8"
                         stroke="currentColor">

                        <path stroke-linecap="round"
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

</nav>