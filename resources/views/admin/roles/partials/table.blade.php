<x-table.table :headers="['Id','Role Name', 'Created At', 'Updated At']">
    @if (count($roles) > 0)
        @foreach ($roles as $role)
            <tr
                class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">

                <x-table.td>{{ $role->id ?? 'N/A' }}</x-table.td>
                <x-table.td>{{ $role->name ?? 'N/A' }}</x-table.td>
                <x-table.td>{{ $role->created_at->format('Y-m-d H:i:s') }}</x-table.td>
                <x-table.td>{{ $role->updated_at->format('Y-m-d H:i:s') }}</x-table.td>
                <x-table.td class="text-right">
                    <x-table.action :id="$role->id" />
                </x-table.td>
            </tr>
        @endforeach
    @else
        <x-table.no-data :colspan="count(['Id','Role Name', 'Created At', 'Updated At']) + 1" />
    @endif
</x-table.table>
<x-table.pagination :paginator="$roles" />
