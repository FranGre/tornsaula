<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __($title) }}
            </h2>

            @if (Auth::user()->role === 'USER_ROLE' && isset($module_id))
                <a href="{{ route('question.create', ['module_id' => $module_id]) }}"
                    class="bg-gray-300 hover:bg-gray-200 rounded dark:bg-neutral-700 hover:dark:bg-neutral-600 text-gray-800 dark:text-gray-200 sm:text-lg sm:px-5 sm:py-3 text-l px-3 py-2">New
                    Question</a>
            @endif

            @if (Auth::user()->role === 'TEACHER_ROLE')
                <a href="{{ route('module.users', ['module_id' => $module_id]) }}"
                    class="bg-gray-300 hover:bg-gray-200 rounded dark:bg-neutral-700 hover:dark:bg-neutral-600 text-gray-800 dark:text-gray-200 sm:text-lg sm:px-5 sm:py-3 text-l px-3 py-2">
                    Mis alumnos</a>
            @endif
        </div>
    </x-slot>

    <livewire:search-questions :pending="$pending" :module_id="$module_id" />
</x-app-layout>
