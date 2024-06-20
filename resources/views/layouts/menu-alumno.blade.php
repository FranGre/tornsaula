<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('questions.index')">
        {{ __('My Questions') }}
    </x-nav-link>
</div>

<!-- Settings Dropdown -->
<div class="hidden sm:flex sm:items-center sm:ms-6">
    @foreach ($modules as $module)
        <x-dropdown align="right" width="48">

            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-neutral-900 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ $module->name }}</div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('questions.module', $module->id)">
                    {{ __('All') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('questions.pending', ['module_id' => $module->id])">
                    {{ __('Pending') }}
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    @endforeach
</div>
