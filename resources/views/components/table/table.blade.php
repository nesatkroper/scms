<div class="overflow-x-auto rounded-md border border-gray-200 dark:border-gray-700 shadow-sm">
    <table class="min-w-full table-auto">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                @foreach ($headers as $header)
                    <th
                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{ $header }}</th>
                @endforeach
                <th
                    class="px-3 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">

            {{ $slot }}

        </tbody>
    </table>
</div>
