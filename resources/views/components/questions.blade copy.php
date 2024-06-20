@if (count($questions) === 0)
    <div class="py-12 text-center">
        <p class="text-lg">No hay preguntas</p>
    </div>
@else
    <div class="py-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul>
                @foreach ($questions as $key => $question)
                    <li
                        class="mb-12 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex items-center sm:flex-row sm:justify-between">
                        <div class="p-6 text-gray-900 dark:text-gray-100 flex-auto">
                            <small>{{ $key + 1 }}
                                {{ $question->user->id === Auth::user()->id ? 'Yo' : $question->user->name }}</small>
                            <h3 class="py-2">{{ $question->title }}</h3>
                            <div class="px-2">
                                <small class="block pt-2">{{ $question->description }}</small>
                                @isset($question->photo)
                                    <img alt="imagen" src="{{ asset('/storage/' . $question->photo) }}"
                                        class="rounded-lg mt-6" />
                                @endisset
                            </div>

                            <div class="pt-12">
                                @isset($question->answer->content)
                                    <small
                                        class="py-2">{{ $question->answer->user->id === Auth::user()->id ? 'Yo' : $question->answer->user->name }}</small>
                                @endisset
                                <blockquote class="px-2">{{ $question->answer->content ?? 'Sin respuesta' }}
                                </blockquote>
                            </div>

                        </div>
                        @if ($question->user_id === Auth::user()->id)
                            <form action="{{ route('question.destroy', $question) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-danger-button class="py-3 px-1 mb-8 sm:py-3 sm:px-5 sm:mr-12"
                                    type="submit">Remove</x-danger-button>
                            </form>
                        @endif

                        @if (Auth::user()->role === 'TEACHER_ROLE')
                            <a href="{{ route('answer.question', $question) }}">
                                <x-primary-button class="py-3 px-1 sm:py-3 sm:px-5 sm:mr-12"
                                    type="button">{{ $question->answer !== null ? 'Editar respuesta' : 'Responder' }}</x-primary-button>
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
