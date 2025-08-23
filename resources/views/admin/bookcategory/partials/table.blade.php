<x-table.table :headers="['Id', 'Name', 'Description', 'Date']" :checkbox="true">
    @if (count($categories) > 0)
        @foreach ($categories as $categorie)
            <x-table.tr>
                <x-table.td>{{ $categorie->id }}</x-table.td>
                <x-table.td>{{ $categorie->name ?? 'N/A' }} ({{ $categorie->books?->count() ?? 0 }})</x-table.td>
                <x-table.td>{{ Str::limit($categorie->description, 30) }}</x-table.td>
                <x-table.td>
                    {{ $categorie->created_at->format('Y-m-d') }}
                </x-table.td>
                <x-table.td class="text-right">
                    <x-table.action :id="$categorie->id" />
                </x-table.td>
                <x-table.td class="px-2 py-2">
                    <x-fields.checkbox id="" name="selected_ids[]" class="row-checkbox"
                        value="{{ $categorie->id }}" />
                </x-table.td>
            </x-table.tr>
        @endforeach
    @else
        <tr>
            <td colspan="12" class="p-4 text-center">
                <x-not-found-data title="categories" />
            </td>
        </tr>
    @endif
</x-table.table>
<x-bulkactions />
