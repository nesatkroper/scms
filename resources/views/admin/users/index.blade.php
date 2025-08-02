@extends('layouts.admin')

@section('title', 'Users')

@section('content')
  <x-page.index title="Users" icon-svg-path="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
    create-button-text="Create New User"
    create-button-icon-svg-path="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">

    <div id="TableContainer">
      <x-table.table :headers="['Id', 'Name', 'Email', 'Phone', 'Type', 'Gender', 'Date of Birth']">
        @if (count($users) > 0)
          @foreach ($users as $user)
            <tr
              class="text-nowrap border-b border-gray-200 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-gray-700">
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

    @include('admin.users.partials.create')
    @include('admin.users.partials.edit')
    @include('admin.users.partials.delete')

  </x-page.index>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      console.log('DOM Content Loaded - Initializing Users page specific scripts.');

      const tableContainer = $('#TableContainer');
      const openCreateBtn = document.getElementById('openCreateModal');

      if (openCreateBtn) {
        openCreateBtn.addEventListener('click', function() {
          console.log('Users page: Create button clicked! Attempting to show Modalcreate.');
          window.showModal('Modalcreate');
        });
      } else {
        console.error('Users page: "openCreateModal" button not found!');
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
              window.closeModal('Modalcreate');
              window.ShowTaskMessage('success', response.message);
              refreshUserContent();
              form.trigger('reset');
            } else {
              window.ShowTaskMessage('error', response.message || 'Error creating user');
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};
            let errorMessages = Object.values(errors).flat().join('\n');
            window.ShowTaskMessage('error', errorMessages || 'Error creating user');
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
              window.showModal('Modaledit');
              window.selectfields();
            } else {
              window.ShowTaskMessage('error', response.message || 'Failed to load user data');
            }
          })
          .fail(function(xhr) {
            console.error('Error:', xhr.responseText);
            window.ShowTaskMessage('error', 'Failed to load user data');
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
              window.closeModal('Modaledit');
              window.ShowTaskMessage('success', response.message);
              refreshUserContent();
            } else {
              window.ShowTaskMessage('error', response.message || 'Error updating user');
            }
          },
          error: function(xhr) {
            const errors = xhr.responseJSON?.errors || {};
            let errorMessages = Object.values(errors).flat().join('\n');
            window.ShowTaskMessage('error', errorMessages || 'Error updating user');
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
        window.showModal('Modaldelete');
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
              window.closeModal('Modaldelete');
              window.ShowTaskMessage('success', response.message);
              refreshUserContent();
            } else {
              window.ShowTaskMessage('error', response.message || 'Error deleting user');
            }
          },
          error: function(xhr) {
            window.ShowTaskMessage('error', xhr.responseJSON?.message || 'Error deleting user');
          },
          complete: function() {
            submitBtn.prop('disabled', false).html(originalBtnHtml);
          }
        });
      }

      function refreshUserContent() {
        console.log('Users page: Refreshing user content.');
        $.ajax({
          url: "{{ route('admin.users.index') }}",
          method: 'GET',
          data: {
            per_page: $('#perPageSelect').val(),
            page: {{ request()->query('page', 1) }}
          },
          success: function(response) {
            if (response.success) {
              tableContainer.html(response.html.table);
              attachRowEventHandlers();
              window.selectfields();
            } else {
              window.ShowTaskMessage('error', 'Failed to refresh user data');
            }
          },
          error: function(xhr) {
            console.error('Users page: Refresh failed:', xhr.responseText);
            window.ShowTaskMessage('error', 'Failed to refresh user data');
          }
        });
      }

      function attachRowEventHandlers() {
        $(document).off('click', '.edit-btn').on('click', '.edit-btn', handleEditClick);
        $(document).off('click', '.delete-btn').on('click', '.delete-btn', handleDeleteClick);
        $(document).off('click', '.detail-btn').on('click', '.detail-btn', handleDetailClick);

        $(document).off('click', '.btn-toggle-dropdown').on('click', '.btn-toggle-dropdown', function(e) {
          e.stopPropagation();
          $(this).closest('.relative').find('.dropdown-menu').toggleClass('hidden');
        });

        $(document).off('click', function(e) {
          if (!$(e.target).closest('.relative').length) {
            $('.dropdown-menu').addClass('hidden');
          }
        });
      }

      function handleDetailClick(e) {
        e.preventDefault();
        const Id = $(this).data('id');
        window.ShowTaskMessage('info', `Details for user ID: ${Id}`);
      }

      function initializeUserPageScripts() {
        console.log('Users page: Initializing form and modal event listeners.');
        $('#Modalcreate form').off('submit').on('submit', handleCreateSubmit);
        $('#Formedit').off('submit').on('submit', handleEditSubmit);
        $('#Formdelete').off('submit').on('submit', handleDeleteSubmit);

        attachRowEventHandlers();
      }

      initializeUserPageScripts();
    });

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
