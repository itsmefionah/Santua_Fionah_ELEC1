<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div style="padding: 40px; background-color: #ebf8ff; border-radius: 0.375rem; color: #1a202c;">
                    {{ __("You're logged in,") }} {{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
