<x-table.table :headers="['Id', 'Name', 'Subject', 'Total Marks', 'Passing Marks', 'Description', 'Date']" :checkbox="true">
    @forelse ($exams as $exam)
        <x-table.tr>
            <x-table.td>{{ $exam->id }}</x-table.td>
            <x-table.td>{{ $exam->name }}</x-table.td>
            <x-table.td>{{ Str::limit($exam->subject?->name ?? 'N/A', 20) }}</x-table.td>
            <x-table.td>{{ $exam->total_marks }} pt</x-table.td>
            <x-table.td>{{ $exam->passing_marks }} pt</x-table.td>
            <x-table.td>{{ Str::limit($exam->description, 40) }}</x-table.td>
            <x-table.td>{{ $exam->date->format('Y-m-d') }}</x-table.td>
            <x-table.td class="text-right">
                <x-table.action :id="$exam->id" />
            </x-table.td>
            <x-table.td>
                <x-fields.checkbox id="" name="selected_ids[]" value="{{ $exam->id }}" class="row-checkbox" />
            </x-table.td>
        </x-table.tr>
    @empty
        <tr>
            <td colspan="9" class="text-center p-4">
                <x-not-found-data title="exams" />
            </td>
        </tr>
    @endforelse
</x-table.table>
