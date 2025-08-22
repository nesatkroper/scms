<x-table.dynamic-table tdclass="capitalize" :headers="[
    'name' => ['label' => 'Name'],
    'roles_count' => ['label' => 'Roles'],
]" :items="$permissions" empty-message="Create your first permissions to get started"
  :checkbox="false" :actions="['edit', 'delete']" />

<x-table.pagination :paginator="$permissions" />
