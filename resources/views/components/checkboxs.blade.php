<div>
    <div class="z-10 bg-white rounded-lg shadow w-60 dark:bg-gray-700">
        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownSearchButton">
            @foreach ($options as $option)
                <li>
                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        @if (in_array($option->id, $modulesSelected))
                            <input type="checkbox" value="{{ $option->id }}" name="{{ $name }}[]" checked
                                class=" w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                        @else
                            <input type="checkbox" value="{{ $option->id }}" name="{{ $name }}[]"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                        @endif
                        <label for="checkbox-item-11"
                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ $option->name }}</label>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
