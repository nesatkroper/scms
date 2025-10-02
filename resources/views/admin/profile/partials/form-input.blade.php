<div class="space-y-1">
  <label for="{{ $name }}"
    class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
    {{ $label }}
  </label>
  <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ $value ?? '' }}"
    class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 @error($name) border-red-500 @enderror"
    {{ $type == 'file' ? '' : (isset($required) && $required === false ? '' : 'required') }}>
  @error($name) <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
</div>