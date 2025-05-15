<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-white leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                    {{ __('Profile Information') }}
                </h3>
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6" style="margin-top: 50px;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                    {{ __('Change Password') }}
                </h3>
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6" style="margin-top: 50px;">
                <h3 class="text-lg font-bold text-red-600 dark:text-red-400 mb-4">
                    {{ __('Delete Account') }}
                </h3>
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
