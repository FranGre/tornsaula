<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (Auth::user()->role === 'TEACHER_ROLE')
            <p class="text-lg"> Tienes <strong>{{ count($questions) }}</strong> por contestar</p>
        @endif
        <x-questions :questions="$questions" />
    </div>
</x-app-layout>
