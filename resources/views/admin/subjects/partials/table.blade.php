<x-table.table :headers="['Id', 'Name', 'Code', 'Credit hours', 'Department', 'Description', 'Date']" :checkbox="true">
    @if (count($subjects) > 0)
        @foreach ($subjects as $subject)
            <x-table.tr>
                <x-table.td>{{ $subject->id }}</x-table.td>
                <x-table.td>{{ $subject->name }}</x-table.td>
                <x-table.td>{{ $subject->code }}</x-table.td>
                <x-table.td>{{ $subject->credit_hours }}</x-table.td>
                <x-table.td>{{ Str::limit($subject->department->name ?? 'N/A', 20) }}</x-table.td>
                <x-table.td>{{ Str::limit($subject->description, 20) }}</x-table.td>
                <x-table.td>
                    {{ $subject->created_at->format('Y-m-d') }}
                </x-table.td>

                <x-table.td class="text-right">
                    <x-table.action :id="$subject->id" />
                </x-table.td>
                <x-table.td class="px-2 py-2">
                    <x-fields.checkbox id="" name="selected_ids[]" class="row-checkbox"
                        value="{{ $subject->id }}" />
                </x-table.td>
            </x-table.tr>
        @endforeach
    @else
         <tr>
            <td colspan="12" class="p-4 text-center">
                <x-not-found-data title="subjects" />
            </td>
        </tr>
    @endif
</x-table.table>
<x-bulkactions />
