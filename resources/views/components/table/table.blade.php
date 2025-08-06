<table class="w-full text-sm text-left">
    <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
        <tr class="text-nowrap">
            @foreach ($headers as $header)
                <th scope="col" class="px-4 py-4">{{ $header }}</th>
            @endforeach
            <th scope="col" class="px-4 py-4">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y  divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
        {{ $slot }}
    </tbody>
</table>
