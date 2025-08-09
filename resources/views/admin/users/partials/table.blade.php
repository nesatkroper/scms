<x-table.dynamic-table  :headers="[
        'name' => ['label' => 'Name','component' => 'table.cell'],
        'phone' => ['label' => 'Phone'],
        'role' => ['label' => 'Type'], 
        'gender' => ['label' => 'Gender'],
        'date_of_birth' => ['label' => 'Date of Birth'],
    ]" :items="$users" empty-message="Create your first users to get started"
    :checkbox="false" :actions="['edit', 'delete']"  />

<x-table.pagination :paginator="$users" />