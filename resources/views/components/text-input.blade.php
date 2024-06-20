@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-gray-300 dark:border-gray-500 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-gray-700 focus:ring-indigo-500 dark:focus:ring-gray-600 rounded-md shadow-sm hover:bg-slate-50 hover:dark:bg-neutral-600 duration-150',
]) !!}>
