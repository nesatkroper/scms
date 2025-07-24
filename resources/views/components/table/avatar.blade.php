<div class="flex items-center">
    @if (isset($data['photo']) && $data['photo'])
        <img class="detail-btn size-10 rounded-full object-cover cursor-pointer" src="{{ asset($data['photo']) }}"
            alt="{{ $data['display'] ?? 'User' }} photo">
    @else
        <img class="detail-btn size-10 rounded-full object-cover cursor-pointer"
            src="https://placehold.co/40x40/6366F1/FFFFFF?text={{ isset($data['display']) ? strtoupper(substr($data['display'], 0, 1)) : 'U' }}"
            alt="{{ $data['display'] ?? 'User' }} image">
    @endif
    <div class="ml-3">
        <div class="font-medium">{{ $data['display'] ?? 'N/A' }}</div>
    </div>
</div>
