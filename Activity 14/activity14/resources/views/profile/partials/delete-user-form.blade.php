<section class="max-w-xl mx-auto bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6 shadow-sm space-y-6">
    <header>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Deleting your account is permanent and cannot be undone. All your data will be lost. Make sure you’ve saved what you need.') }}
        </p>
    </header>

    <div class="flex justify-between items-center">
        <div class="text-sm text-gray-800 dark:text-gray-200">
            {{ __('Ready to delete your account?') }}
        </div>

        <x-danger-button
            x-data
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            {{ __('Delete') }}
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
            @csrf
            @method('delete')

            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Confirm Deletion') }}
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Please enter your password to confirm you want to permanently delete your account and all its associated data.') }}
                </p>
            </div>

            <div>
                <x-input-label for="password" value="{{ __('Password') }}" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('••••••••') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-danger-button class="ms-3">
                    {{ __('Yes, Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
