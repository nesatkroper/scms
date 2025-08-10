<x-table.dynamic-table :headers="[
    'name' => ['label' => 'Name'],
    'roles_count' => ['label' => 'Roles'],
]" :items="$permissions" empty-message="Create your first permissions to get started"
  :checkbox="false" :actions="['edit', 'delete']" />

<x-table.pagination :paginator="$permissions" />
