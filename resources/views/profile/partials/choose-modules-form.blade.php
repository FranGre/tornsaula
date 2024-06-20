<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Modules Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update your modules profile.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.store.modules') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="modules" :value="__('Modules')" />
            <x-checkboxs :options="$modules" name="modules" :modulesSelected="$modulesSelected" />
            <x-input-error class="mt-2" :messages="$errors->get('modules')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button
                class="dark:bg-green-500 dark:hover:bg-green-400 bg-green-500 hover:bg-green-400">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
