@extends('layouts.admin')
@section('title', 'Users')
@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      {{-- Icon for Users --}}
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
      </svg>
      Users
    </h3>
    <div
      class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">
      <button id="openCreateModal"
        class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
            clip-rule="evenodd" />
        </svg>
        Create New User
      </button>
      <div class="flex items-center mt-3 md:mt-0 gap-2">
        <div class="relative w-full">
          <input type="search" id="searchInput" placeholder="Search users..."
            class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
            focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
          <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
        </div>
        <button id="resetSearch"
          class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors">
          <i class="ri-reset-right-line text-indigo-600 dark:text-gray-300 text-xl"></i>
        </button>
        <div
          class="switchtab flex items-center gap-1 dark:bg-gray-700 p-1 border border-gray-200 dark:border-gray-500 rounded-lg">
          <button id="listViewBtn"
            class="p-2 size-6 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-indigo-200 dark:hover:bg-indigo-600 rounded-md transition-colors">
            <i class="ri-list-check text-xl text-indigo-600 dark:text-indigo-300"></i>
          </button>
          <button id="cardViewBtn"
            class="p-2 size-6 flex items-center justify-center cursor-pointer bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors">
            <i class="ri-grid-fill text-xl text-indigo-600 dark:text-indigo-300"></i>
          </button>
        </div>
      </div>
    </div>
    <div id="TableContainer" class="table-respone mt-6 overflow-x-auto h-[60vh]">
      @include('admin.users.partials.table', ['users' => $users])
    </div>
    <div id="CardContainer" class="hidden my-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      @include('admin.users.partials.cardlist', ['users' => $users])
    </div>
    {{-- pagination --}}
    @include('admin.users.partials.pagination')

  </div>
  <!-- Modal Backdrop -->
  <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

  @include('admin.users.partials.create')
  @include('admin.users.partials.edit')
  @include('admin.users.partials.delete')
@endsection
@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Core Configuration
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      // Initialize custom select fields
      selectfields();

      function selectfields() {
        document.querySelectorAll('.custom-select').forEach(select => {
          const header = select.querySelector('.select-header');
          const optionsBox = select.querySelector('.select-options');
          const searchInput = select.querySelector('.search-input');
          const optionsContainer = select.querySelector('.options-container');
          const selectedValue = select.querySelector('.selected-value');
          const noResults = select.querySelector('.no-results');
          const options = Array.from(select.querySelectorAll('.select-option'));
          const hiddenInput = document.querySelector(`input[name="${select.dataset.name}"]`);

          // Toggle dropdown
          header.addEventListener('click', function() {
            select.classList.toggle('open');
            if (select.classList.contains('open')) {
              searchInput.focus();
            }
          });

          // Filter options
          searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase().trim();
            let hasMatch = false;

            options.forEach(option => {
              if (option.textContent.toLowerCase().includes(term)) {
                option.style.display = 'block';
                hasMatch = true;
              } else {
                option.style.display = 'none';
              }
            });

            noResults.style.display = hasMatch ? 'none' : 'block';
          });

          // Select option
          options.forEach(option => {
            option.addEventListener('click', function() {
              options.forEach(opt => opt.classList.remove('selected'));
              this.classList.add('selected');
              selectedValue.textContent = this.textContent;
              hiddenInput.value = this.dataset.value;
              select.classList.remove('open');
              console.log('Selected department_id:', this.dataset.value);
            });
          });

          // Close when clicking outside
          document.addEventListener('click', function(e) {
            if (!select.contains(e.target)) {
              select.classList.remove('open');
            }
          });
        });
      }

      // DOM Elements
      const backdrop = document.getElementById('modalBackdrop');
      const searchInput = $('#searchInput');
      const resetSearch = $('#resetSearch');
      const listViewBtn = $('#listViewBtn');
      const cardViewBtn = $('#cardViewBtn');
      const tableContainer = $('#TableContainer');
      const cardContainer = $('#CardContainer');

      const openCreateBtn = document.getElementById('openCreateModal');
      if (openCreateBtn) {
        openCreateBtn.addEventListener('click', function() {
          showModal('Modalcreate');
        });
      }

      // View Management
      function setView(viewType) {
        if (viewType === 'list') {
          listViewBtn.addClass('bg-indigo-100 dark:bg-indigo-700').removeClass(
            'bg-gray-100 dark:bg-gray-700');
          cardViewBtn.addClass('bg-gray-100 dark:bg-gray-700').removeClass(
            'bg-indigo-100 dark:bg-indigo-700');
          tableContainer.removeClass('hidden');
          cardContainer.addClass('hidden');
        } else {
          cardViewBtn.addClass('bg-indigo-100 dark:bg-indigo-700').removeClass(
            'bg-gray-100 dark:bg-gray-700');
          listViewBtn.addClass('bg-gray-100 dark:bg-gray-700').removeClass(
            'bg-indigo-100 dark:bg-indigo-700');
          tableContainer.addClass('hidden');
          cardContainer.removeClass('hidden');
        }
        localStorage.setItem('viewitem', viewType);
      }

      function handleCreateSubmit(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = $('#createSubmitBtn');
        const originalBtnHtml = submitBtn.html();

        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

        $.ajax({
          url: form.attr('action'),
          method: 'POST',
          data: form.serialize(),
          success: function(response) {
            if (response.success) {
              closeModal('Modalcreate');
              ShowTaskMessage('success', response.message);
              refreshUserContent(); // Changed from refreshSubjectContent
              form.trigger('reset');
            } else {
              ShowTaskMessage('error', response.message || 'Error creating user'); // Changed message
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};
            let errorMessages = Object.values(errors).flat().join('\n');
            ShowTaskMessage('error', errorMessages || 'Error creating user'); // Changed message
          },
          complete: function() {
            submitBtn.prop('disabled', false).html(originalBtnHtml);
          }
        });
      }

      function handleEditClick(e) {
        e.preventDefault();
        const editBtn = $(this);
        const originalContent = editBtn.find('.btn-content').html();
        editBtn.find('.btn-content').html(
          '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Loading...</span>');
        editBtn.prop('disabled', true);

        const Id = $(this).data('id');

        $.get(`/admin/users/${Id}`) // Changed URL from exams to users
          .done(function(response) {
            if (response.success) {
              // Populate edit form fields with user data
              $('#edit_name').val(response.user.name); // Changed from response.exam
              $('#edit_email').val(response.user.email);
              $('#edit_phone').val(response.user.phone);
              $('#edit_address').val(response.user.address);
              $('#edit_date_of_birth').val(response.user.date_of_birth);
              $('#edit_gender').val(response.user.gender);
              $('#edit_avatar').val(response.user.avatar);
              $('#edit_type').val(response.user.type);

              $('#Formedit').attr('action', `users/${Id}`); // Changed action URL
              showModal('Modaledit');
            } else {
              ShowTaskMessage('error', response.message || 'Failed to load user data'); // Changed message
            }
          })
          .fail(function(xhr) {
            console.error('Error:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to load user data'); // Changed message
          })
          .always(function() {
            editBtn.find('.btn-content').html(originalContent);
            editBtn.prop('disabled', false);
          });
      }

      function handleEditSubmit(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = $('#saveEditBtn');
        const originalBtnHtml = submitBtn.html();

        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Saving...');

        $.ajax({
          url: form.attr('action'),
          method: 'POST',
          data: form.serialize() + '&_method=PUT',
          success: function(response) {
            if (response.success) {
              closeModal('Modaledit');
              ShowTaskMessage('success', response.message);
              refreshUserContent(); // Changed from refreshSubjectContent
            } else {
              ShowTaskMessage('error', response.message || 'Error updating user'); // Changed message
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};
            let errorMessages = Object.values(errors).flat().join('\n');
            ShowTaskMessage('error', errorMessages || 'Error updating user'); // Changed message
          },
          complete: function() {
            submitBtn.prop('disabled', false).html(originalBtnHtml);
          }
        });
      }

      function handleDeleteClick(e) {
        e.preventDefault();
        const Id = $(this).data('id');
        $('#Formdelete').attr('action', `/admin/users/${Id}`); // Changed URL
        showModal('Modaldelete');
      }

      function handleDeleteSubmit(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = $('#confirmDeleteBtn');
        const originalBtnHtml = submitBtn.html();

        submitBtn.prop('disabled', true).html(
          '<i class="fas fa-spinner fa-spin"></i><span class="ml-2 textnone">Deleting...</span>');

        $.ajax({
          url: form.attr('action'),
          method: 'POST',
          data: {
            _method: 'DELETE'
          },
          success: function(response) {
            if (response.success) {
              closeModal('Modaldelete');
              ShowTaskMessage('success', response.message);
              refreshUserContent(); // Changed from refreshSubjectContent
            } else {
              ShowTaskMessage('error', response.message || 'Error deleting user'); // Changed message
            }
          },
          error: function(xhr) {
            ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting user'); // Changed message
          },
          complete: function() {
            submitBtn.prop('disabled', false).html(originalBtnHtml);
          }
        });
      }

      // Modal Management
      function showModal(modalId) {
        backdrop.classList.remove('hidden');
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        setTimeout(() => {
          modal.querySelector('div').classList.remove('opacity-0', 'scale-95');
          modal.querySelector('div').classList.add('opacity-100', 'scale-100');
        }, 10);
        document.body.style.overflow = 'hidden';
      }

      function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.querySelector('div').classList.remove('opacity-100', 'scale-100');
        modal.querySelector('div').classList.add('opacity-0', 'scale-95');

        setTimeout(() => {
          modal.classList.add('hidden');
          backdrop.classList.add('hidden');
          document.body.style.overflow = 'auto';
        }, 300);
      }

      // Utility Functions
      function refreshUserContent() { // Renamed from refreshSubjectContent
        const currentView = localStorage.getItem('viewitem') || 'list'; // Default to 'list'
        const searchTerm = searchInput.val() || '';

        $.ajax({
          url: "{{ route('admin.users.index') }}", // Changed route
          method: 'GET',
          data: {
            search: searchTerm,
            view: currentView
          },
          success: function(response) {
            if (response.success) {
              tableContainer.html(response.html.table);
              cardContainer.html(response.html.cards);
              $('.pagination').html(response.html.pagination);
              attachRowEventHandlers();
            } else {
              ShowTaskMessage('error', 'Failed to refresh user data'); // Changed message
            }
          },
          error: function(xhr) {
            console.error('Refresh failed:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to refresh user data'); // Changed message
          }
        });
      }

      function attachRowEventHandlers() {
        $('.edit-btn').off('click').on('click', handleEditClick);
        $('.delete-btn').off('click').on('click', handleDeleteClick);
        $('.detail-btn').off('click').on('click', handleDetailClick); // Assuming you still have a detail button
        // Removed bulk action related event handlers
      }

      function debounce(func, wait) {
        let timeout;
        return function() {
          const context = this,
            args = arguments;
          clearTimeout(timeout);
          timeout = setTimeout(() => func.apply(context, args), wait);
        };
      }

      // Event Listeners
      function initialize() {
        // Set initial view
        const savedView = localStorage.getItem('viewitem') || 'list';
        setView(savedView);

        // View toggle
        listViewBtn.on('click', () => setView('list'));
        cardViewBtn.on('click', () => setView('card'));

        // Search
        searchInput.on('input', debounce(() => refreshUserContent(), 500)); // Call refreshUserContent directly
        resetSearch.on('click', () => {
          searchInput.val('');
          refreshUserContent(); // Call refreshUserContent directly
        });

        // Form submissions
        $('#Modalcreate form').off('submit').on('submit', handleCreateSubmit);
        $('#Formedit').off('submit').on('submit', handleEditSubmit);
        $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);

        // Modal close buttons
        $('[id^="close"], [id^="cancel"]').on('click', function() {
          const modalId = $(this).closest('[id^="Modal"]').attr('id') ||
            $(this).closest('[id$="Modal"]').attr('id');
          if (modalId) closeModal(modalId);
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape') {
            $('[id^="Modal"]').each(function() {
              if (!$(this).hasClass('hidden')) {
                closeModal(this.id);
              }
            });
          }
        });

        // Attach initial event handlers
        attachRowEventHandlers();
      }

      // Start the application
      initialize();
    });

    // Global notification function (kept as is)
    function ShowTaskMessage(type, message) {
      const TasksmsContainer = document.createElement('div');
      TasksmsContainer.className = `fixed top-5 right-4 z-50 animate-fade-in-out`;
      TasksmsContainer.innerHTML = `
        <div class="flex items-start gap-3 ${type === 'success' ? 'bg-green-200/80 dark:bg-green-900/60 border-green-400 dark:border-green-600 text-green-700 dark:text-green-300' : 'bg-red-200/80 dark:bg-red-900/60 border-red-400 dark:border-red-600 text-red-700 dark:text-red-300'}
            border backdrop-blur-sm px-4 py-3 rounded-lg shadow-lg">
            <svg class="w-6 h-6 flex-shrink-0 ${type === 'success' ? 'text-green-500 dark:text-green-400' : 'text-red-500 dark:text-red-400'} mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="${type === 'success' ? 'M5 13l4 4L19 7' : 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'}" />
            </svg>
            <div class="flex-1 text-sm sm:text-base">${message}</div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-gray-600 rounded-full dark:text-gray-400 hover:bg-gray-100/30 dark:hover:bg-gray-50/10 focus:outline-none">
                <svg class="w-5 h-5 rounded-full" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    `;
      document.body.appendChild(TasksmsContainer);
      setTimeout(() => TasksmsContainer.remove(), 3000);
    }
  </script>
@endpush
