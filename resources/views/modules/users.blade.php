<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $moduleName }} - Alumnos
        </h2>
    </x-slot>

    <div class="py-20">
        @if (count($users) >= 1)
            <p class="text-lg">Hay <strong>{{ count($users) }}</strong> alumno/s</p>
            <table class="w-full text-center border-collapse table-auto sm:table-fixed">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Preguntas</th>
                    </tr>
                </thead>
                <tbody class="border-y-4">
                    @foreach ($users as $user)
                        @if ($user->role === 'USER_ROLE')
                            <tr class="border-b-2">
                                <td class="border">{{ $user->name }}</td>
                                <td class="border">{{ $user->email }}</td>
                                <td class="border flex justify-">
                                    <div>
                                        <strong>{{ count($user->questions) }}</strong> pregunta/s
                                    </div>
                                    <a href="hola"
                                        class="bg-gray-300 hover:bg-gray-200 rounded dark:bg-neutral-700 hover:dark:bg-neutral-600 text-gray-800 dark:text-gray-200 sm:text-lg sm:px-5 sm:py-3 text-l px-3 py-2">
                                        Ver preguntas
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-lg">No hay nigún alumno</p>
        @endif

    </div>
</x-app-layout>
