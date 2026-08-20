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
        class="notification-dropdown fixed inset-x-4 top-[76px] sm:absolute sm:inset-x-auto sm:top-auto sm:right-0 sm:mt-3 w-auto sm:w-[380px] bg-white rounded-2xl border border-gray-200 shadow-xl z-50 overflow-hidden">

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
                                            'add_customer',
                                            'add_user'
                                                => 'bg-indigo-50 text-indigo-600',

                                            'report_updated',
                                            'edit_report',
                                            'edit_issue',
                                            'edit_site',
                                            'edit_customer',
                                            'edit_user'
                                                => 'bg-blue-50 text-blue-600',

                                            'report_deleted',
                                            'delete_report',
                                            'delete_issue',
                                            'delete_site',
                                            'delete_customer',
                                            'delete_user'
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
                            'add_customer',
                            'add_user'
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
                            ['report_updated', 'edit_report', 'edit_issue', 'edit_site', 'edit_customer', 'edit_user']
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
                            'delete_customer',
                            'delete_user']
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

                                    {{ $message }}

                                </p>

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