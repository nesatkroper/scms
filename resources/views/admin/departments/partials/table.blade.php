<x-table.table :headers="['Id', 'Name','Teachers','Subjects', 'Description', 'Date']" :checkbox="true">
    @if (count($departments) > 0)
        @foreach ($departments as $department)
            <x-table.tr>
                <x-table.td>{{ $department->id }}</x-table.td>
                <x-table.td>{{ $department->name }}</x-table.td>
                <x-table.td>{{ $department->teachers?->count() ?? 0 }}</x-table.td>
                <x-table.td>{{ $department->subjects?->count() ?? 0 }}</x-table.td>
                <x-table.td>{{ Str::limit($department->description, 40) }}</x-table.td>
                <x-table.td>
                    {{ $department->created_at->format('Y-m-d') }}
                </x-table.td>
                <x-table.td class="text-right">
                    <x-table.action :id="$department->id" />
                </x-table.td>
                <x-table.td class="px-2 py-2">
                    <x-fields.checkbox id="" name="selected_ids[]" class="row-checkbox"
                        value="{{ $department->id }}" />
                </x-table.td>
            </x-table.tr>
        @endforeach
    @else
        <tr>
            <td colspan="12" class="p-4 text-center">
                <x-not-found-data title="departments" />
            </td>
        </tr>
    @endif
</x-table.table>
<x-bulkactions />
