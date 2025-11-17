{{-- <x-table.dynamic-table :headers="[
    'name' => ['label' => 'Name', 'component' => 'table.cell'],
    'phone' => ['label' => 'Phone'],
    'role' => ['label' => 'Type'],
    'gender' => ['label' => 'Gender'],
    'date_of_birth' => ['label' => 'Date of Birth'],
]" :items="$users" empty-message="Create your first users to get started"
  :checkbox="false" :actions="['edit', 'delete']" />

<x-table.pagination :paginator="$users" /> --}}

<x-table.dynamic-table :headers="[
    'name' => ['label' => 'User Name', 'component' => 'table.cell'],
    'role' => [
        'label' => 'Role',
        // 💡 Displays the user's primary role, capitalized
        'format' => fn($item) => $item->roles->first()?->name ? Str::title($item->roles->first()->name) : 'N/A',
    ],
    'email' => ['label' => 'Email'],
    // 'department' => [
    //     'label' => 'Department',
    //     'format' => fn($item) => $item->department->name ?? 'N/A',
    // ],
    'phone' => ['label' => 'Phone'],
    'joining_date' => [
        'label' => 'Joining Date',
        // 💡 Formats the date cleanly
        'format' => fn($item) => $item->joining_date ? $item->joining_date->format('M d, Y') : 'N/A',
    ],
    'gender' => ['label' => 'Gender'],
]" :items="$users" empty-message="Create your first users to get started"
  :checkbox="false" :actions="['edit', 'delete']" />

<x-table.pagination :paginator="$users" />
