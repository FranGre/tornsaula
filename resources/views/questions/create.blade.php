<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <section class="text-gray-800 dark:text-gray-200 py-20">
        <div class="mb-24 px-10 pt-10 pb-12 bg-white dark:bg-neutral-800 shadow-sm rounded-lg">
            <p class="font-thin">
                {{ __(ucfirst($module->name)) }}
            </p>
            <form method="post"
                action="{{ isset($question) ? route('question.update', ['question_id' => $question->id]) : route('question.store', ['module_id' => $module->id]) }}"
                enctype="multipart/form-data" class="mt-6 space-y-6">
                @csrf
                @isset($question)
                    @method('PATCH')
                @endisset

                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full dark:bg-neutral-700"
                    placeholder="Title..." value="{{ isset($question) ? $question->title : null }}" />
                @error('title')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

                <x-textarea name="description"
                    placeholder="Description...">{{ isset($question) ? $question->description : null }} </x-textarea>
                @error('description')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

                <x-input-label for="photo" :value="__('Photo')" />
                <x-text-input id="phto" name="photo" type="file" class="mt-1 block w-full" />
                @error('photo')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror

                <div class="flex items-center gap-4 pt-12">
                    <x-primary-button class="py-3 px-1 mb-8 sm:py-3 sm:px-5 sm:mr-12 bg-green-400 hover:bg-green-300 dark:bg-green-500 dark:hover:bg-green-400">{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
