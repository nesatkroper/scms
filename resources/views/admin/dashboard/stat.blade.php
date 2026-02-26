<div class="box grid sm:grid-cols-2 grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
  <!-- Fees Collected -->
  <div class="bg-white dark:bg-gray-800 dark:hover:bg-amber-950 rounded-[2rem] p-5 border border-gray-200
             dark:border-gray-700 shadow-sm relative">
    <div class="flex justify-between">
      <div>
        <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.fees_collected') }}</p>
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
          ${{ number_format($feesCollected, 2) }}</h3>
      </div>
      <div class="h-12 w-12 rounded-full bg-amber-500 bg-opacity-20 flex items-center justify-center">
        <i class="fas fa-dollar-sign text-amber-100 dark:text-amber-200 text-xl"></i>
      </div>
    </div>
    <div>
      @if($feesUnpaid != 0)
        <p class="text-red-500 dark:text-red-400 text-sm font-medium">{{ __('message.fees_pending') }}</p>
        <h3 class="text-xl font-bold text-red-800 dark:text-red-400 mt-1">
          - ${{ number_format($feesUnpaid, 2) }}</h3>
      @endif
    </div>
  </div>

  <!-- Fees Collected -->
  <div class="bg-white dark:bg-gray-800 dark:hover:bg-amber-950 rounded-[2rem] p-5 border border-gray-200
             dark:border-gray-700 shadow-sm relative">
    <div class="flex justify-between">
      <div>
        <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.expense_cost') }}</p>
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
          ${{ number_format($totalExpense, 2) }}</h3>
      </div>
      <div class="h-12 w-12 rounded-full bg-amber-500 bg-opacity-20 flex items-center justify-center">
        <i class="fas fa-dollar-sign text-amber-100 dark:text-amber-200 text-xl"></i>
      </div>

    </div>
    <div>
      @if($pendingExpense != 0)
        <p class="text-red-500 dark:text-red-400 text-sm font-medium">{{ __('message.expense_pending') }}</p>
        <h3 class="text-xl font-bold text-red-800 dark:text-red-400 mt-1">
          - ${{ number_format($pendingExpense, 2) }}</h3>
      @endif
    </div>

  </div>

  <!-- Total Students -->
  <div
    class="bg-white dark:hover:bg-blue-950 dark:bg-gray-800 rounded-[2rem] p-5 border border-gray-200 dark:border-gray-700 shadow-sm relative"
    id="student-card">
    <div class="flex justify-between">
      <div>
        <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.total_students') }}</p>
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($totalStudents, 0) }}
        </h3>
      </div>
      <div class="h-12 w-12 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center">
        <i class="fas fa-user-graduate text-blue-100 dark:text-blue-200 text-xl"></i>
      </div>
    </div>
    <div>
      <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.total_teachers') }}</p>
      <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($totalTeachers, 0) }}</h3>
    </div>

  </div>

  <!-- Active Classes -->
  <div class="bg-white dark:bg-gray-800 dark:hover:bg-green-950 rounded-[2rem] p-5 border border-gray-200
             dark:border-gray-700 shadow-sm relative">
    <div class="flex justify-between">
      <div>
        <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.active_course') }}</p>
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($activeCourse, 0) }}
        </h3>
      </div>
      <div class="h-12 w-12 rounded-full bg-green-500 bg-opacity-20 flex items-center justify-center">
        <i class="fas fa-book text-green-100 dark:text-green-200 text-xl"></i>
      </div>
    </div>
    <div>
      <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.classrooms') }}</p>
      <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ number_format($totalClassroom, 0) }}
      </h3>
    </div>

  </div>

</div>