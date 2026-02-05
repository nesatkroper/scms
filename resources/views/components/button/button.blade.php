@props(['btnType' => 'primary', 'id' => null, 'type' => 'button'])

@php
  $base = 'cursor-pointer flex items-center justify-center rounded-md transition-colors';

  $variants = [
      'cancel' => 'p-2 border border-red-500 text-red-500 hover:text-white hover:bg-red-600',
      'save' => 'p-2 bg-indigo-600 text-white hover:bg-indigo-700',
      'success' => 'p-2 bg-green-600 text-white hover:bg-green-700',
      'primary' => 'p-2 bg-blue-600 text-white hover:bg-blue-700',
  ];
@endphp

<button type="{{ $type }}" id="{{ $id }}"
  {{ $attributes->merge(['class' => "$base " . ($variants[$btnType] ?? $variants['primary'])]) }}>
  {{ $slot }}
</button>
