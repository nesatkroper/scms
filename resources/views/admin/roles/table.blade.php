<x-table.dynamic-table :headers="[
    'id' => ['label' => 'Id'],
    'name' => ['label' => 'Name'],
    'permissions_count' => ['label' => 'Permissions'],
    'users_count' => ['label' => 'Users'],
]" endpoint="roles" :items="$roles"
    empty-message="Create your first roles to get started" :checkbox="false" :actions="['edit', 'delete']" />

<x-table.pagination :paginator="$roles" />
