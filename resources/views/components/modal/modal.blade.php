class rounded-xl w-full max-w-lg 
id = Modalcreate 
<div id="{{ $id }}" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="{{ $attributes->merge(['class' => 'relative bg-white dark:bg-gray-800 shadow-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600' . $class]) }}">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="{{$svgPath}}"
                        clip-rule="evenodd" />
                </svg>
                Create New {{$title}}
            </h3>
            closeCreateModal
            <x-button.btnclose id="closeCreateModal"/>
        </div>
        {{ $slot }}
        <!-- Form Content -->
        <form action="{{ route('admin.bookcategory.store') }}" method="POST" class="p-4 needs-validation" novalidate>
            @csrf

            <div class="h-[65vh] md:h-auto">
                <div class="grid grid-cols-1 gap-1 sm:gap-4 mb-2">
                    <!-- Name Field -->
                    <x-fields.input label="Name" name="name" placeholder="Enter name" :required="true" />
                    <!-- Description Field -->
                    <x-fields.textarea label="Description" name="description" placeholder="Enter description" />
                </div>
            </div>

            
            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelCreateModal"
                    class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </button>
                <button type="submit" id="createSubmitBtn"
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Create
                </button>
            </div>
        </form>

    </div>
</div>
