<!-- Create Modal -->
<div id="Modalcreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-lg transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Create New Section
            </h3>
            <button id="closeCreateModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form action="{{ route('admin.sections.store') }}" method="POST" class="p-4">
            @csrf

            <div class="h-[65vh] md:h-auto">
                <div class="grid grid-cols-1 gap-1 sm:gap-4 mb-2">
                    <!-- Name Field -->
                    <div class="mb-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full px-3 py-2 border rounded-md focus:outline
                 focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                      dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('name') border-red-500 @else border-gray-400 @enderror"
                            placeholder="Enter section name" required>

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grade Level Field -->
                    <div class="mb-2">
                        <label for="grade_level_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Grade Level <span class="text-red-500">*</span>
                        </label>

                        <div data-name="grade_level_id"
                            class="custom-select relative w-full px-3 py-2 border rounded-md focus:outline
                 focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                      dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('grade_level_id') border-red-500 @else border-gray-400 @enderror">
                            <div class="select-header cursor-pointer flex justify-between items-center">
                                <span class="selected-value">
                                    {{ old('grade_level_name', 'Select grade level') }}
                                </span>
                                <span class="arrow transition-transform duration-300">▼</span>
                            </div>
                            <div
                                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">
                                <div class="search-container p-2 sticky top-0 z-1 bg-white dark:bg-slate-700">
                                    <input type="search"
                                        class="search-input text-sm w-full px-3 py-2 border rounded-md focus:outline
                 focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                      dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                                        placeholder="Search grade level...">
                                </div>
                                <div class="options-container">
                                    @foreach ($gradeLevels as $gradeLevel)
                                        <div class="{{ old('grade_level_id') == $gradeLevel->id ? 'selected' : '' }} 
                                            select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600"
                                            data-value="{{ $gradeLevel->id }}">
                                            {{ $gradeLevel->name }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="no-results p-2 text-center text-red-500" style="display: none;">No results
                                    found</div>
                            </div>
                        </div>

                        <!-- Hidden input for form submission -->
                        <input type="hidden" name="grade_level_id" id="grade_level_id"
                            value="{{ old('grade_level_id') }}">

                        @error('grade_level_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teacher Field -->
                    <div class="mb-2">
                        <label for="teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Teacher
                        </label>

                        <div data-name="teacher_id"
                            class="custom-select relative w-full px-3 py-2 border rounded-md focus:outline
                 focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                      dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                        @error('teacher_id') border-red-500 @else border-gray-400 @enderror">
                            <div class="select-header cursor-pointer flex justify-between items-center">
                                <span class="selected-value">
                                    {{ old('teacher_name', 'Select teacher') }}
                                </span>
                                <span class="arrow transition-transform duration-300">▼</span>
                            </div>
                            <div
                                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">
                                <div class="search-container p-2 sticky top-0 z-1 bg-white dark:bg-slate-700">
                                    <input type="search"
                                        class="search-input text-sm w-full px-3 py-2 border rounded-md focus:outline
                 focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                      dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                                        placeholder="Search teacher...">
                                </div>
                                <div class="options-container">

                                    @foreach ($teachers as $teacher)
                                        <div class="{{ old('teacher_id') == $teacher->id ? 'selected' : '' }} 
                                            select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600"
                                            data-value="{{ $teacher->id }}">
                                            {{ $teacher->name }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="no-results p-2 text-center text-red-500" style="display: none;">No results
                                    found</div>
                            </div>
                        </div>

                        <!-- Hidden input for form submission -->
                        <input type="hidden" name="teacher_id" id="teacher_id" value="{{ old('teacher_id') }}">
                        @error('teacher_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
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
