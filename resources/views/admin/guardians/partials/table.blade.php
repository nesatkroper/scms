<x-table.dynamic-table :headers="[
    'name' => ['label' => 'Name', 'component' => 'table.cell'],
    'phone' => ['label' => 'Phone'],
    'email' => ['label' => 'Email'],
    'company' => ['label' => 'Company'],
    'address' => ['label' => 'Address'],
    'occupation' => ['label' => 'Occupation'],
    'relation' => ['label' => 'Relation'],
    'created_at' => ['label' => 'Date'],
]" :items="$guardians" empty-message="Create your first users to get started"
    :checkbox="false" :actions="['edit', 'delete']" />

<x-table.pagination :paginator="$guardians" />
