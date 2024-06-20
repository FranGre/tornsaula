<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('modules.update', $module) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <h1 class="pb-12 text-3xl">Editar Modulo</h1>
                        <p>{{ $module }}</p>
                        <div class="mb-4">
                            <label for="name"
                                class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Name</label>
                            <input type="text" name="name" value="{{ $module->name }}"
                                class="block appearance-none border rounded text-gray-700 leading-tight">

                            @error('name')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description"
                                class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Description</label>
                            <input type="text" name="description" value="{{ $module->description }}"
                                class="block appearance-none border rounded w-full text-gray-700 leading-tight">

                            @error('description')
                                <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit"
                            class="py-3 px-4 mt-12 bg-green-400 hover:bg-green-500 rounded-full dark:text-black">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
