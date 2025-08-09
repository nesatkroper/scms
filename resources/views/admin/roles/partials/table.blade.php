<x-table.dynamic-table :headers="[
    'id' => ['label' => 'Id'],
    'name' => ['label' => 'Name'],
    'created_at' => ['label' => 'Created At'],
    'updated_at' => ['label' => 'Updated At'],
]" :items="$roles" empty-message="Create your first roles to get started"
    :checkbox="false" :actions="['edit', 'delete']" />

<x-table.pagination :paginator="$roles" />
