
 <x-table.table :headers="[
    'Id',
    'Name',
    'Description',
    'Date',
]" :checkbox="true">
    @if (count($categories) > 0)
        @foreach ($categories as $categorie)
            <tr
                class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
                <x-table.td>{{ $categorie->id}}</x-table.td>
                <x-table.td>{{ $categorie->name ?? 'N/A' }} ({{ $categorie->books?->count() ?? 0 }})</x-table.td>
                <x-table.td>{{ Str::limit($categorie->description, 30) }}</x-table.td>
                <x-table.td>
                    {{ $categorie->created_at->format('Y-m-d') }}
                </x-table.td>
                <x-table.td class="text-right">
                    <x-table.action :id="$categorie->id" />
                </x-table.td>
                <x-table.td class="px-2 py-2">
                    <input type="checkbox" name="selected_ids[]" value="{{ $categorie->id }}"
                        class="row-checkbox appearance-none size-4 
                            border-2 border-gray-300 dark:border-gray-600 rounded-sm cursor-pointer transition-all duration-200 ease-in-out relative
                            checked:bg-indigo-500 dark:checked:bg-indigo-600 checked:border-indigo-500 dark:checked:border-indigo-600
                            hover:border-indigo-400 dark:hover:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-700
                            focus:ring-offset-2 focus:outline-none before:content-[''] before:absolute before:inset-0 before:bg-no-repeat before:bg-center
                            before:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjIwIDYgOSAxNyA0IDEyIj48L3BvbHlsaW5lPjwvc3ZnPg==')]
                            before:opacity-0 before:transition-opacity before:duration-200 checked:before:opacity-100">
                </x-table.td>
            </tr>
        @endforeach
    @else
        <x-table.no-data :colspan="count([
            'Id',
            'Name',
    'Description',
    'Date',
        ]) + 1" />
    @endif
</x-table.table>
<x-bulkactions />
<x-table.pagination :paginator="$categories" />
