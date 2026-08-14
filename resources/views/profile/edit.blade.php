<x-app-layout>
    <x-slot name="header">
        <div class="data-management-header">
            <div class="reports-header-content flex items-center justify-between gap-6 p-5 sm:p-6">
                <div class="flex items-center gap-4">
                    <div class="data-management-header-icon">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zm-9.249 13.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="data-management-header-title">{{ __('Profile') }}</h2>
                        <p class="data-management-header-description">Kelola informasi akun dan keamanan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="reports-page py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="data-management-section">
                <div class="data-management-section-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="data-management-section">
                <div class="data-management-section-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="data-management-section">
                <div class="data-management-section-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>