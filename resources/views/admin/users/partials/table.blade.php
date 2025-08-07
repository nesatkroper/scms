<x-table.table :headers="['Name', 'Phone', 'Type', 'Gender', 'Date of Birth']">
    @if (count($users) > 0)
        @foreach ($users as $user)
            <tr
                class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
                <x-table.td class="whitespace-nowrap text-gray-900 dark:text-white">
                    <div class="flex items-center">
                        @if ($user->avatar)
                            <img class="w-10 h-10 rounded-full object-cover cursor-grab" src="{{ asset($user->avatar) }}"
                                alt="{{ $user->name }} image" data-id="{{ $user->id }}">
                        @else
                            <div
                                class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-white font-bold cursor-default select-none">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif

                        <div class="pl-3">
                            <div class="text-base font-semibold">
                                {{ $user->name }}
                            </div>
                            <div class="font-normal text-gray-500 truncate">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>

                </x-table.td>
                <x-table.td>{{ $user->phone ?? 'N/A' }}</x-table.td>
                <x-table.td> {{ $user->getRoleNames()->first() ?? 'N/A' }}</x-table.td>
                <x-table.td>{{ ucfirst($user->gender ?? 'N/A') }}</x-table.td>
                <x-table.td>
                    {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : 'N/A' }}
                </x-table.td>
                <x-table.td class="text-right">
                    <x-table.action :id="$user->id"/>
                </x-table.td>
            </tr>
        @endforeach
    @else
        <x-table.no-data :colspan="count(['Id', 'Name', 'Phone', 'Type', 'Gender', 'Date of Birth']) + 1" />
    @endif
</x-table.table>
<x-table.pagination :paginator="$users" />
