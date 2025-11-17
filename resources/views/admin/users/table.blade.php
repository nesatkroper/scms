<x-table.dynamic-table :headers="[
    'name' => ['label' => 'User Name', 'component' => 'table.cell'],
    'role' => [
        'label' => 'Role',
        'format' => fn($item) => $item->roles->first()?->name ? Str::title($item->roles->first()->name) : 'N/A',
    ],
    'email' => ['label' => 'Email'],
    'phone' => ['label' => 'Phone'],
    'joining_date' => [
        'label' => 'Joining Date',
        'format' => fn($item) => $item->joining_date ? $item->joining_date->format('M d, Y') : 'N/A',
    ],
    'gender' => ['label' => 'Gender'],
]" :items="$users" empty-message="Create your first users to get started"
  :checkbox="false" :actions="['edit', 'delete']" />
<x-table.pagination :paginator="$users" />
