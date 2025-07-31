@extends('layouts.admin')
@section('title', 'Users')
@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
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
    </div>
    <x-table.table :headers="['Id', 'Name', 'Email', 'Phone', 'Type', 'Gender', 'Date of Birth']">
      @if (count($users) > 0)
        @foreach ($users as $user)
          <tr class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
            <x-table.td>{{ $user->id }}</x-table.td>
            <x-table.td>{{ $user->name }}</x-table.td>
            <x-table.td>{{ $user->email }}</x-table.td>
            <x-table.td>{{ $user->phone ?? 'N/A' }}</x-table.td>
            <x-table.td>{{ ucfirst($user->type) }}</x-table.td>
            <x-table.td>{{ ucfirst($user->gender ?? 'N/A') }}</x-table.td>
            <x-table.td>
              {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : 'N/A' }}
            </x-table.td>
            <x-table.td class="text-right">
              <x-table.action :userId="$user->id" />
            </x-table.td>
          </tr>
        @endforeach
      @else
        <x-table.no-data :colspan="count(['Id', 'Name', 'Email', 'Phone', 'Type', 'Gender', 'Date of Birth']) + 1" />
      @endif
    </x-table.table>
    <x-table.pagination :paginator="$users" />

  </div>
  <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

  @include('admin.users.partials.create')
  @include('admin.users.partials.edit')
  @include('admin.users.partials.delete')
@endsection
@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


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

          header.addEventListener('click', function() {
            select.classList.toggle('open');
            if (select.classList.contains('open')) {
              searchInput.focus();
            }
          });

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

          options.forEach(option => {
            option.addEventListener('click', function() {
              options.forEach(opt => opt.classList.remove('selected'));
              this.classList.add('selected');
              selectedValue.textContent = this.textContent;
              hiddenInput.value = this.dataset.value;
              select.classList.remove('open');
              console.log('Selected value:', this.dataset.value); // Updated log message
            });
          });

          document.addEventListener('click', function(e) {
            if (!select.contains(e.target)) {
              select.classList.remove('open');
            }
          });
        });
      }

      selectfields();

      const backdrop = document.getElementById('modalBackdrop');
      const tableContainer = $('#TableContainer');

      const openCreateBtn = document.getElementById('openCreateModal');
      if (openCreateBtn) {
        openCreateBtn.addEventListener('click', function() {
          showModal('Modalcreate');
        });
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
              refreshUserContent();
              form.trigger('reset');
            } else {
              ShowTaskMessage('error', response.message || 'Error creating user');
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};
            let errorMessages = Object.values(errors).flat().join('\n');
            ShowTaskMessage('error', errorMessages || 'Error creating user');
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

        $.get(`/admin/users/${Id}`)
          .done(function(response) {
            if (response.success) {
              $('#edit_name').val(response.user.name);
              $('#edit_email').val(response.user.email);
              $('#edit_phone').val(response.user.phone);
              $('#edit_address').val(response.user.address);
              $('#edit_date_of_birth').val(response.user.date_of_birth);

              // Update custom select for gender
              const editGenderSelect = document.querySelector('#Modaledit .custom-select[data-name="gender"]');
              const editGenderSelectedValue = editGenderSelect.querySelector('.selected-value');
              const editGenderHiddenInput = document.querySelector('#edit_gender');
              editGenderHiddenInput.value = response.user.gender;
              editGenderSelectedValue.textContent = response.user.gender ? response.user.gender.charAt(0)
                .toUpperCase() + response.user.gender.slice(1) : 'Select Gender';
              editGenderSelect.querySelectorAll('.select-option').forEach(option => {
                if (option.dataset.value === response.user.gender) {
                  option.classList.add('selected');
                } else {
                  option.classList.remove('selected');
                }
              });

              // Update custom select for type
              const editTypeSelect = document.querySelector('#Modaledit .custom-select[data-name="type"]');
              const editTypeSelectedValue = editTypeSelect.querySelector('.selected-value');
              const editTypeHiddenInput = document.querySelector('#edit_type');
              editTypeHiddenInput.value = response.user.type;
              editTypeSelectedValue.textContent = response.user.type ? response.user.type.charAt(0).toUpperCase() +
                response.user.type.slice(1) : 'Select Type';
              editTypeSelect.querySelectorAll('.select-option').forEach(option => {
                if (option.dataset.value === response.user.type) {
                  option.classList.add('selected');
                } else {
                  option.classList.remove('selected');
                }
              });

              $('#edit_avatar').val(response.user.avatar);

              $('#Formedit').attr('action', `users/${Id}`);
              showModal('Modaledit');
            } else {
              ShowTaskMessage('error', response.message || 'Failed to load user data');
            }
          })
          .fail(function(xhr) {
            console.error('Error:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to load user data');
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
              refreshUserContent();
            } else {
              ShowTaskMessage('error', response.message || 'Error updating user');
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};
            let errorMessages = Object.values(errors).flat().join('\n');
            ShowTaskMessage('error', errorMessages || 'Error updating user');
          },
          complete: function() {
            submitBtn.prop('disabled', false).html(originalBtnHtml);
          }
        });
      }

      function handleDeleteClick(e) {
        e.preventDefault();
        const Id = $(this).data('id');
        $('#Formdelete').attr('action', `/admin/users/${Id}`);
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
              refreshUserContent();
            } else {
              ShowTaskMessage('error', response.message || 'Error deleting user');
            }
          },
          error: function(xhr) {
            ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting user');
          },
          complete: function() {
            submitBtn.prop('disabled', false).html(originalBtnHtml);
          }
        });
      }

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

      function refreshUserContent() {
        $.ajax({
          url: "{{ route('admin.users.index') }}",
          method: 'GET',
          data: {}, // Removed search and view parameters
          success: function(response) {
            if (response.success) {
              tableContainer.html(response.html.table);
              $('.pagination').html(response.html.pagination);
              attachRowEventHandlers();
            } else {
              ShowTaskMessage('error', 'Failed to refresh user data');
            }
          },
          error: function(xhr) {
            console.error('Refresh failed:', xhr.responseText);
            ShowTaskMessage('error', 'Failed to refresh user data');
          }
        });
      }

      function attachRowEventHandlers() {
        $('.edit-btn').off('click').on('click', handleEditClick);
        $('.delete-btn').off('click').on('click', handleDeleteClick);
        $('.detail-btn').off('click').on('click', handleDetailClick);
      }

      // Initialize event listeners
      function initialize() {
        $('#Modalcreate form').off('submit').on('submit', handleCreateSubmit);
        $('#Formedit').off('submit').on('submit', handleEditSubmit);
        $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);

        $('[id^="close"], [id^="cancel"]').on('click', function() {
          const modalId = $(this).closest('[id^="Modal"]').attr('id') ||
            $(this).closest('[id$="Modal"]').attr('id');
          if (modalId) closeModal(modalId);
        });

        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape') {
            $('[id^="Modal"]').each(function() {
              if (!$(this).hasClass('hidden')) {
                closeModal(this.id);
              }
            });
          }
        });

        attachRowEventHandlers();
      }

      initialize();
    });

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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const perPageSelect = document.getElementById('perPageSelect');
      if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
          const selectedValue = this.value;
          const currentUrl = new URL(window.location.href);
          currentUrl.searchParams.set('per_page', selectedValue);
          currentUrl.searchParams.delete('page');
          window.location.href = currentUrl.toString();
        });
      }
    });
  </script>
@endpush
