<div id="Modaledit" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
  <div
    class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
    <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg"
          class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          viewBox="0 0 20 20" fill="currentColor">
          <path
            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
        </svg>
        Edit User
      </h3>
      <button id="closeEditModal"
        class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <form id="Formedit" method="POST" class="p-4">
      @csrf
      @method('PUT')

      <div class="h-[65vh] md:h-auto px-4 overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-1 sm:gap-4 mb-2">
          <div class="mb-2">
            <label for="edit_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Name <span class="text-red-500">*</span>
            </label>
            <input type="text" id="edit_name" name="name"
              class="w-full px-3 py-2 border rounded-md focus:outline
                           focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                           dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
              placeholder="Enter name" required>
            <p class="invalid-feedback error-name mt-1 text-sm text-red-600"></p>
          </div>

          <div class="mb-2">
            <label for="edit_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Email <span class="text-red-500">*</span>
            </label>
            <input type="email" id="edit_email" name="email"
              class="w-full px-3 py-2 border rounded-md focus:outline
                           focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                           dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
              placeholder="Enter email" required>
            <p class="invalid-feedback error-email mt-1 text-sm text-red-600"></p>
          </div>

          <div class="mb-2">
            <label for="edit_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              New Password
            </label>
            <input type="password" id="edit_password" name="password"
              class="w-full px-3 py-2 border rounded-md focus:outline
                           focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                           dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
              placeholder="Leave blank to keep current password">
            <p class="invalid-feedback error-password mt-1 text-sm text-red-600"></p>
          </div>

          <div class="mb-2">
            <label for="edit_password_confirmation"
              class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Confirm New Password
            </label>
            <input type="password" id="edit_password_confirmation" name="password_confirmation"
              class="w-full px-3 py-2 border rounded-md focus:outline
                           focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                           dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
              placeholder="Confirm new password">
            <p class="invalid-feedback error-password_confirmation mt-1 text-sm text-red-600"></p>
          </div>

          <div class="mb-2">
            <label for="edit_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              User Type <span class="text-red-500">*</span>
            </label>
            <div data-name="type"
              class="form-control custom-select relative w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                           dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
              <div class="select-header cursor-pointer flex justify-between items-center">
                <span class="selected-value" id="edit_type_selected_value">Select Type</span>
                <span class="arrow transition-transform duration-300">▼</span>
              </div>
              <div
                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">
                {{-- Removed search-container and search-input --}}
                <div class="options-container">
                  @foreach (['admin', 'teacher', 'student', 'parent', 'staff'] as $typeOption)
                    <div
                      class="select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600"
                      data-value="{{ $typeOption }}">
                      {{ ucfirst($typeOption) }}
                    </div>
                  @endforeach
                </div>
                {{-- Removed no-results --}}
              </div>
            </div>
            <input type="hidden" name="type" id="edit_type" value="">
            <p class="invalid-feedback error-type mt-1 text-sm text-red-600"></p>
          </div>

          <div class="mb-2">
            <label for="edit_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Phone
            </label>
            <input type="tel" id="edit_phone" name="phone"
              class="w-full px-3 py-2 border rounded-md focus:outline
                           focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                           dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
              placeholder="Enter phone number">
            <p class="invalid-feedback error-phone mt-1 text-sm text-red-600"></p>
          </div>

          <div class="mb-2">
            <label for="edit_date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Date of Birth
            </label>
            <input type="date" id="edit_date_of_birth" name="date_of_birth"
              class="w-full px-3 py-2 border rounded-md focus:outline
                           focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                           dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
            <p class="invalid-feedback error-date_of_birth mt-1 text-sm text-red-600"></p>
          </div>

          <div class="mb-2">
            <label for="edit_gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Gender
            </label>
            <div data-name="gender"
              class="form-control custom-select relative w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                           dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
              <div class="select-header cursor-pointer flex justify-between items-center">
                <span class="selected-value" id="edit_gender_selected_value">Select Gender</span>
                <span class="arrow transition-transform duration-300">▼</span>
              </div>
              <div
                class="select-options absolute z-10 top-full left-0 right-0 max-h-[250px] overflow-y-auto hidden shadow-md rounded-sm bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600">
                {{-- Removed search-container and search-input --}}
                <div class="options-container">
                  @foreach (['male', 'female', 'other'] as $genderOption)
                    <div
                      class="select-option px-[10px] py-2 cursor-pointer border-b border-slate-200 dark:border-slate-600"
                      data-value="{{ $genderOption }}">
                      {{ ucfirst($genderOption) }}
                    </div>
                  @endforeach
                </div>
                {{-- Removed no-results --}}
              </div>
            </div>
            <input type="hidden" name="gender" id="edit_gender" value="">
            <p class="invalid-feedback error-gender mt-1 text-sm text-red-600"></p>
          </div>

          <div class="mb-2 col-span-1 md:col-span-2">
            <label for="edit_avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Avatar URL
            </label>
            <input type="text" id="edit_avatar" name="avatar"
              class="w-full px-3 py-2 border rounded-md focus:outline
                           focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                           dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                           border-slate-300"
              placeholder="Enter avatar URL (optional)">
            <p class="invalid-feedback error-avatar mt-1 text-sm text-red-600"></p>
          </div>

          <div class="mb-2 col-span-1 md:col-span-2">
            <label for="edit_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Address
            </label>
            <textarea id="edit_address" name="address" rows="2"
              class="w-full px-3 py-2 border rounded-md focus:outline
                           focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                           dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300"
              placeholder="Enter user address"></textarea>
            <p class="invalid-feedback error-address mt-1 text-sm text-red-600"></p>
          </div>
        </div>
      </div>
      <div class="flex justify-end space-x-3 pt-4 px-4 border-t border-gray-200 dark:border-gray-700">
        <button type="button" id="cancelEditModal"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:text-white hover:bg-red-600 text-red-500 rounded-md flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          Cancel
        </button>
        <button type="submit" id="saveEditBtn"
          class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
          <span class="btn-content flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            Save Changes
          </span>
        </button>
      </div>
    </form>
  </div>
</div>
