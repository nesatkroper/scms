<!-- Create User Modal -->
<div id="Modalcreate" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
  <div
    class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
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
        Create New User
      </h3>
      <button id="closeCreateModal"
        class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Form Content -->
    <form id="ModalcreateForm" action="{{ route('admin.users.store') }}" method="POST" class="py-4">
      @csrf

      <div class="h-[65vh] md:h-auto px-4 overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-1 sm:gap-4 mb-2">
          <!-- Name Field -->
          <div class="mb-2">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Name <span class="text-red-500">*</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
              class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                                    border-slate-300"
              placeholder="Enter name" required>
            <p class="invalid-feedback error-name mt-1 text-sm text-red-600"></p>
          </div>

          <!-- Email Field -->
          <div class="mb-2">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Email <span class="text-red-500">*</span>
            </label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
              class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                                    border-slate-300"
              placeholder="Enter email" required>
            <p class="invalid-feedback error-email mt-1 text-sm text-red-600"></p>
          </div>

          <!-- Password Field -->
          <div class="mb-2">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Password <span class="text-red-500">*</span>
            </label>
            <input type="password" id="password" name="password"
              class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                                    border-slate-300"
              placeholder="Enter password" required>
            <p class="invalid-feedback error-password mt-1 text-sm text-red-600"></p>
          </div>

          <!-- Type Field (Custom Select) - Now Dynamic -->
          <div class="mb-2">
            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              User Role <span class="text-red-500">*</span>
            </label>
            <div data-name="type"
              class="form-control custom-select relative w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
              <div class="select-header cursor-pointer flex justify-between items-center">
                <span class="selected-value">
                  {{ old('type', 'Select Type') }}
                </span>
                <span class="arrow transition-transform duration-300">▼</span>
              </div>
              <div
                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">
                <div class="search-container p-2 sticky top-0 z-1 bg-white dark:bg-slate-700">
                  <input type="search"
                    class="search-input text-sm w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                                                dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                    placeholder="Search types...">
                </div>
                <div class="options-container">
                  {{-- Iterate over roles passed from the controller --}}
                  @foreach ($roles as $role)
                    <div
                      class="{{ old('type') == $role->name ? 'selected' : '' }}
                                                select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600"
                      data-value="{{ $role->name }}">
                      {{ ucfirst($role->name) }}
                    </div>
                  @endforeach
                </div>
                <div class="no-results p-2 text-center text-red-500" style="display: none;">No results
                  found</div>
              </div>
            </div>
            <input type="hidden" name="type" id="type" value="{{ old('type') }}">
            <p class="error-type mt-1 text-sm text-red-600"></p>
          </div>

          <!-- Phone Field -->
          <div class="mb-2">
            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Phone
            </label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
              class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                                    border-slate-300"
              placeholder="Enter phone number">
            <p class="invalid-feedback error-phone mt-1 text-sm text-red-600"></p>
          </div>

          <!-- Date of Birth Field -->
          <div class="mb-2">
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Date of Birth
            </label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}"
              class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                                    border-slate-300">
            <p class="invalid-feedback error-date_of_birth mt-1 text-sm text-red-600"></p>
          </div>

          <!-- Gender Field (Custom Select) -->
          <div class="mb-2">
            <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Gender
            </label>
            <div data-name="gender"
              class="form-control custom-select relative w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
              <div class="select-header cursor-pointer flex justify-between items-center">
                <span class="selected-value">
                  {{ old('gender', 'Select Gender') }}
                </span>
                <span class="arrow transition-transform duration-300">▼</span>
              </div>
              <div
                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">
                <div class="search-container p-2 sticky top-0 z-1 bg-white dark:bg-slate-700">
                  <input type="search"
                    class="search-input text-sm w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                                                dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
                    placeholder="Search genders...">
                </div>
                <div class="options-container">
                  @foreach (['male', 'female', 'other'] as $genderOption)
                    <div
                      class="{{ old('gender') == $genderOption ? 'selected' : '' }}
                                                select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600"
                      data-value="{{ $genderOption }}">
                      {{ ucfirst($genderOption) }}
                    </div>
                  @endforeach
                </div>
                <div class="no-results p-2 text-center text-red-500" style="display: none;">No results
                  found</div>
              </div>
            </div>
            <input type="hidden" name="gender" id="gender" value="{{ old('gender') }}">
            <p class="error-gender mt-1 text-sm text-red-600"></p>
          </div>

          <!-- Avatar Field -->
          <div class="mb-2 col-span-1 md:col-span-2">
            <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Avatar
            </label>
            <input type="file" id="avatar" name="avatar"
              class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                border-slate-300">
            <p class="invalid-feedback error-avatar mt-1 text-sm text-red-600"></p>

            @if (isset($user) && $user->avatar)
              <div class="mt-2">
                <img src="{{ asset($user->avatar) }}" alt="Current Avatar"
                  class="w-20 h-20 object-cover rounded-full">
                <label class="inline-flex items-center mt-2">
                  <input type="checkbox" name="clear_avatar" value="1" class="form-checkbox">
                  <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Clear Avatar</span>
                </label>
              </div>
            @endif
          </div>

          <!-- Address Field (full width) -->
          <div class="mb-2 col-span-1 md:col-span-2">
            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Address
            </label>
            <textarea id="address" name="address" rows="2"
              class="form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
              placeholder="Enter user address">{{ old('address') }}</textarea>
            <p class="invalid-feedback error-address mt-1 text-sm text-red-600"></p>
          </div>
        </div>
      </div>
      <!-- Form Actions -->
      <div class="flex justify-end space-x-3 pt-4 px-4 border-t border-gray-200 dark:border-gray-700">
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
          Save
        </button>
      </div>
    </form>
  </div>
</div>
