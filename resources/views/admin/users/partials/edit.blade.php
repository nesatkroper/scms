<div class="mb-2">
  <label for="edit_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
    User Type <span class="text-red-500">*</span>
  </label>
  <div data-name="type"
    class="form-control custom-select relative w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300">
    <div class="select-header cursor-pointer flex justify-between items-center">
      <span class="selected-value">
        {{ old('type', $user->roles->first() ? ucfirst($user->roles->first()->name) : 'Select Type') }}
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
        @foreach ($roles as $role)
          <div
            class="{{ old('type') == $role->name || ($user->roles->first() && $user->roles->first()->name == $role->name) ? 'selected' : '' }}
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
  <input type="hidden" name="type" id="edit_type" value="{{ old('type', $user->roles->first()->name ?? '') }}">
  <p class="error-type mt-1 text-sm text-red-600"></p>
</div>
