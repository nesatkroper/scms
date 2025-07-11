 @if ($bookIssues->hasPages())
     <div class="flex items-center justify-between border-t border-gray-200 dark:border-gray-700 px-4 pt-3 sm:px-6">
         <div class="flex flex-1 justify-between sm:hidden">
             @if ($bookIssues->onFirstPage())
                 <span
                     class="relative inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                     Previous
                 </span>
             @else
                 <a href="{{ $bookIssues->previousPageUrl() }}"
                     class="relative inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                     Previous
                 </a>
             @endif

             @if ($bookIssues->hasMorePages())
                 <a href="{{ $bookIssues->nextPageUrl() }}"
                     class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                     Next
                 </a>
             @else
                 <span
                     class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed">
                     Next
                 </span>
             @endif
         </div>
         <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
             <div>
                 <p class="text-sm text-gray-700 dark:text-gray-300">
                     Showing
                     <span class="font-medium">{{ $bookIssues->firstItem() }}</span>
                     to
                     <span class="font-medium">{{ $bookIssues->lastItem() }}</span>
                     of
                     <span class="font-medium">{{ $bookIssues->total() }}</span>
                     results
                 </p>
             </div>
             <div class="flex items-center space-x-2">
                 <div class="flex items-center">
                     <span class="text-sm text-gray-700 dark:text-gray-300 mr-2">Rows per page:</span>
                     <select id="perPageSelect"
                         class="text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:text-gray-300">
                         <option value="10" {{ $bookIssues->perPage() == 10 ? 'selected' : '' }}>10</option>
                         <option value="15" {{ $bookIssues->perPage() == 15 ? 'selected' : '' }}>15</option>
                         <option value="20" {{ $bookIssues->perPage() == 20 ? 'selected' : '' }}>20</option>
                         <option value="25" {{ $bookIssues->perPage() == 25 ? 'selected' : '' }}>25</option>
                     </select>
                 </div>
                 <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                     @if ($bookIssues->onFirstPage())
                         <span
                             class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 dark:text-gray-500 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0 cursor-not-allowed">
                             <span class="sr-only">Previous</span>
                             <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                 <path fill-rule="evenodd"
                                     d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                     clip-rule="evenodd" />
                             </svg>
                         </span>
                     @else
                         <a href="{{ $bookIssues->previousPageUrl() }}"
                             class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-700 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0">
                             <span class="sr-only">Previous</span>
                             <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                 <path fill-rule="evenodd"
                                     d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                     clip-rule="evenodd" />
                             </svg>
                         </a>
                     @endif

                     @foreach ($bookIssues->getUrlRange(1, $bookIssues->lastPage()) as $page => $url)
                         @if ($page == $bookIssues->currentPage())
                             <span aria-current="page"
                                 class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                 {{ $page }}
                             </span>
                         @else
                             <a href="{{ $url }}"
                                 class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0">
                                 {{ $page }}
                             </a>
                         @endif
                     @endforeach

                     @if ($bookIssues->hasMorePages())
                         <a href="{{ $bookIssues->nextPageUrl() }}"
                             class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-700 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0">
                             <span class="sr-only">Next</span>
                             <svg class="h-5 w-5 rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                 <path fill-rule="evenodd"
                                     d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                     clip-rule="evenodd" />
                             </svg>
                         </a>
                     @else
                         <span
                             class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 dark:text-gray-500 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 focus:z-20 focus:outline-offset-0 cursor-not-allowed">
                             <span class="sr-only">Next</span>
                             <svg class="h-5 w-5 rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                 <path fill-rule="evenodd"
                                     d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                     clip-rule="evenodd" />
                             </svg>
                         </span>
                     @endif
                 </nav>
             </div>
         </div>
     </div>
 @endif
