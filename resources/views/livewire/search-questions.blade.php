<div wire:key="search-questions-component">
    @if (count($questions) === 0)
        <div class="py-12 text-center">
            <p class="text-lg">No hay preguntas</p>
        </div>
    @else
        <div class="py-20">
            <div class="max-w-7xl mx-auto">
                <input type="search" wire:model.live.debounce.350ms="search" placeholder="Search questions..."
                    class="mb-12" />

                <ul class="text-gray-800 dark:text-gray-200">
                    @foreach ($questions as $question)
                        <li class="mb-24 px-10 pt-10 pb-12 bg-white dark:bg-neutral-800 shadow-sm rounded-lg">
                            <div class="flex justify-between pb-6 font-thin">
                                @if ($module_id === null)
                                    <p>{{ $question->module->name }}</p>
                                @else
                                    <p>{{ $question->user->id === Auth::user()->id ? 'Yo' : $question->user->name }}</p>
                                @endif
                            </div>

                            <div class="pb-16">
                                <h3 class="py-2 text-xl font-bold">{{ $question->title }}</h3>
                                <p class="pt-4 text-lg">{{ $question->description }}</p>
                                @isset($question->photo)
                                    <img alt="imagen" src="{{ asset('/storage/' . $question->photo) }}"
                                        class="rounded-lg mt-6" />
                                @endisset
                            </div>

                            <div class="{{ isset($question->answer) ? 'pb-16' : '' }}">
                                @isset($question->answer->content)
                                    <p class="pb-6 font-thin">
                                        {{ $question->answer->user->id === Auth::user()->id ? 'Yo' : $question->answer->user->name }}
                                    </p>
                                @endisset
                                <p class="text-lg">
                                    {{ $question->answer->content ?? 'Sin respuesta' }}
                                </p>
                            </div>

                            <div class="flex">
                                @if ($question->user_id === Auth::user()->id)
                                    @if ($question->answer === null)
                                        <form action="{{ route('question.edit', $question) }}" method="POST"
                                            class="pt-12">
                                            @csrf
                                            @method('POST')
                                            <x-primary-button
                                                class="py-3 px-1 mb-8 sm:py-3 sm:px-5 sm:mr-12 bg-gray-300 hover:bg-gray-200 dark:bg-neutral-600 hover:dark:bg-neutral-500"
                                                type="submit">Edit
                                            </x-primary-button>
                                        </form>
                                    @endif
                                    <form action="{{ route('question.destroy', $question) }}" method="POST"
                                        class="pt-12">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="py-3 px-1 mb-8 sm:py-3 sm:px-5 sm:mr-12"
                                            type="submit">Remove
                                        </x-danger-button>
                                    </form>
                                @endif

                                @if (Auth::user()->role === 'TEACHER_ROLE')
                                    <a href="{{ route('answer.question', $question) }}" class="pt-12">
                                        <x-primary-button
                                            class="py-3 px-1 sm:py-3 sm:px-5 sm:mr-12 dark:bg-sky-500 bg-sky-500 hover:bg-sky-400 hover:dark:bg-sky-400"
                                            type="button">{{ $question->answer !== null ? 'Editar respuesta' : 'Responder' }}
                                        </x-primary-button>
                                    </a>
                                @endif
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
