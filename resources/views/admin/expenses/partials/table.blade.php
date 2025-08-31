<x-table.table :headers="['Id', 'Title', 'Amount', 'Category','Approved by', 'Description', 'Date']" :checkbox="true">
    @if (count($expenses) > 0)
        @foreach ($expenses as $expense)
            <x-table.tr>
                <x-table.td>{{ $expense->id }}</x-table.td>
                <x-table.td>{{ $expense->title }}</x-table.td>
                <x-table.td>{{ $expense->amount }}</x-table.td>
                <x-table.td>{{ $expense->category }}</x-table.td>
                <x-table.td>{{ $expense->approvedBy?->name ?? 'N/A' }}</x-table.td>
                <x-table.td>{{ Str::limit($expense->description, 40) }}</x-table.td>
                <x-table.td>
                    {{ $expense->date?->format('Y-m-d H:i') ?? 'N/A' }}
                </x-table.td>
                <x-table.td class="text-right">
                    <x-table.action :id="$expense->id" />
                </x-table.td>
                <x-table.td class="px-2 py-2">
                    <x-fields.checkbox id="" name="selected_ids[]" class="row-checkbox"
                        value="{{ $expense->id }}" />
                </x-table.td>
            </x-table.tr>
        @endforeach
    @else
        <tr>
            <td colspan="12" class="p-4 text-center">
                <x-not-found-data title="expenses" />
            </td>
        </tr>
    @endif
</x-table.table>
<x-bulkactions />
