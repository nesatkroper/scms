<table class="w-full text-sm text-left">
  <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
    <tr class="text-nowrap">
      <th scope="col" class="px-4 py-4">Id</th>
      <th scope="col" class="px-4 py-4">Name</th>
      <th scope="col" class="px-4 py-4">Email</th>
      <th scope="col" class="px-4 py-4">Phone</th>
      <th scope="col" class="px-4 py-4">Type</th>
      <th scope="col" class="px-4 py-4">Gender</th>
      <th scope="col" class="px-4 py-4">Date of Birth</th>
      <th scope="col" class="px-4 py-4">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if (count($users) > 0)
      @foreach ($users as $user)
        <tr class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
          <td class="px-4 py-2">{{ $user->id }}</td>
          <td class="px-4 py-2">{{ $user->name }}</td>
          <td class="px-4 py-2">{{ $user->email }}</td>
          <td class="px-4 py-2">{{ $user->phone ?? 'N/A' }}</td>
          <td class="px-4 py-2">{{ ucfirst($user->type) }}</td>
          <td class="px-4 py-2">{{ ucfirst($user->gender ?? 'N/A') }}</td>
          <td class="px-4 py-2">
            {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : 'N/A' }}
          </td>

          <td class="px-4 py-2 text-right">
            <div class="relative">
              <button
                class="btn-toggle-dropdown btn-action font-medium text-indigo-600 dark:text-indigo-500 p-1 size-8 flex items-center justify-center
                                border border-indigo-100 dark:border-gray-600 dark:hover:bg-gray-700 hover:bg-indigo-200 rounded-full cursor-pointer transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
                </svg>
              </button>

              <!-- Dropdown Menu -->
              <div
                class="dropdown-menu hidden absolute w-auto right-0 z-10 mt-2 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
                role="menu">
                <div class="py-1" role="none">
                  <a href="#" title="Edit Id({{ $user->id }})"
                    class="edit-btn text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2"
                    data-id="{{ $user->id }}">
                    <span class="btn-content flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path
                          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                      </svg>
                      Edit
                    </span>
                  </a>
                  <a href="#" title="Details Id({{ $user->id }})"
                    class="text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2 detail-btn"
                    data-id="{{ $user->id }}">
                    <span class="btn-content flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                          clip-rule="evenodd" />
                      </svg>
                      Details
                    </span>
                  </a>
                  <button href="#" title="Delete Id({{ $user->id }})"
                    class="delete-btn text-red-600 dark:text-red-400 w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2"
                    data-id="{{ $user->id }}">
                    <span class="btn-content flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                          clip-rule="evenodd" />
                      </svg>
                      Delete
                    </span>
                  </button>

                </div>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
    @else
      <tr>
        <td colspan="8" class="p-4 text-center"> {{-- Adjusted colspan --}}
          <div class="col-span-full py-12 text-center">
            <div
              class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-red-400 dark:text-red-500"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Users Found</h3>
              <p class="mt-2 text-sm text-red-500 dark:text-red-500">Create your first user to get started
              </p>
            </div>
          </div>
        </td>
      </tr>
    @endif
  </tbody>
</table>
