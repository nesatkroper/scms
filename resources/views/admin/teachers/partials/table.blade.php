<x-table.dynamic-table 
    :headers="[
        'name' => [
            'label' => 'Teacher',
            'component' => 'table.cell'
        ],
        'gender' => ['label' => 'Gender'],
        'experience' => ['label' => 'Experience'],
        'department.name' => ['label' => 'Department'],
        'salary' => ['label' => 'Salary'],
        'qualification' => ['label' => 'Qualification'],
        'specialization' => ['label' => 'Specialization'],
        'joining_date' => ['label' => 'Joining Date'],
    ]" 
    :items="$teachers" 
    empty-message="No teachers found"
    :checkbox="true" 
    :actions="true" 
/>

<x-bulkactions />
<x-table.pagination :paginator="$teachers" />