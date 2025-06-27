@props(['name' => 'bradtrump'])
<div
    {{ $attributes->merge(['class' => 'flex items-center space-x-2 bg-gradient-to-r from-blue-500 to-teal-400 text-white px-4 py-2']) }}>
    <i class="fas fa-user-astronaut text-xl"></i>
    <span class="font-bold text-xl">{{ $name }}</span>
</div>
