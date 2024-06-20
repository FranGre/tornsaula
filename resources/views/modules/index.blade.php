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
                    <table>
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                                <tr>
                                    <td>{{ $module->id }}</td>
                                    <td>{{ $module->name }}</td>
                                    <td>{{ $module->description }}</td>
                                    <td>
                                        <a href="{{ route('modules.show', $module) }}">
                                            <img src="{{ asset('build/assets/eye.svg') }}" alt="show" height="25"
                                                width="25">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('modules.edit', $module) }}">
                                            <img src="{{ asset('build/assets/edit.svg') }}" alt="edit"
                                                height="25" width="25">
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('modules.destroy', $module) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <img src="{{ asset('build/assets/bin.svg') }}" alt="delete"
                                                    height="25" width="25">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('modules.create') }}" class="p-4 ml-12 bg-sky-500 hover:bg-sky-600 rounded-full">Añadir
        Módulo</a>
</x-app-layout>
