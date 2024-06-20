<x-app-layout>

    <section class="mt-12 py-9 text-gray-800 dark:text-gray-200">
        <div class="mb-24 px-10 pt-10 pb-12 bg-white dark:bg-neutral-800 shadow-sm rounded-lg border">
            <form method="post"
                action="{{ isset($answer->content) ? route('answer.update', $answer->id) : route('answer.store') }}">
                @csrf
                @if ($question->content)
                    @method('PATCH')
                @endif

                <input type="hidden" name="question_id" value="{{ $question->id }}">

                <div class="flex justify-between pb-6 font-thin">
                    <p>{{ $question->user->name }}</p>
                </div>

                <div class="pb-16">
                    <h3 class="py-2 text-xl font-bold">{{ $question->title }}</h3>
                    <p class="pt-4 text-lg">{{ $question->description }}</p>
                    @isset($question->photo)
                        <img alt="imagen" src="{{ asset('/storage/' . $question->photo) }}" class="rounded-lg mt-6" />
                    @endisset
                </div>

                <div class="pb-24">
                    <x-input-label for="Respuesta" value="Respuesta" />
                    <x-textarea name="content">{{ $answer->content ?? null }}</x-textarea>
                    @error('content')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button
                        class="py-3 px-1 mb-8 sm:py-3 sm:px-5 sm:mr-12 bg-green-400 hover:bg-green-300 dark:bg-green-500 dark:hover:bg-green-400">{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
